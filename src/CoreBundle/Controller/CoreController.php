<?php
/**
 * Created by PhpStorm.
 * User: Manon
 * Date: 20-12-15
 * Time: 12:33
 */

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/*Entity*/
use CoreBundle\Entity\Contacte;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Entity\Animals;
use UserBundle\Entity\Dispo;
use UserBundle\Entity\Message;
use UserBundle\Entity\User;
/*form*/
use CoreBundle\Form\ContacteType;
use UserBundle\Form\DispoSearchType;
use UserBundle\Form\MessageType;

class CoreController extends Controller{

    /*
     * partie qui recois les donnée marche pas.*/

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new DispoSearchType());
        $userVille = $em->getRepository('UserBundle:User')->userVille();

        if($request->getMethod() == 'POST')
        {
            /*dump($_POST);*/
            $form->submit($request);
            //On vérifie que les valeurs entrées sont correctes
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                //On récupère les données entrées dans le formulaire par l'utilisateur
                $data = $request->get('UserBundle_Dispo_Search');
//                dump($data);
                //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire
                $liste_dispo = $em->getRepository('UserBundle:Dispo')->isDispo($data);
                $search = ['list' => $liste_dispo, 'nbr' => count($liste_dispo)];
                dump($liste_dispo, $_SESSION);
                $session = $request->getSession();
                $session->set('result',$search);
                $ne = $session->get('result');
                dump($session, $ne);
                return $this->redirect($this->generateUrl('core_annonce'));
            }
        }

        return $this->render('CoreBundle:Core:index.html.twig', array(
            'ville'   => $userVille,
            'form'    => $form->createView()
        ));
    }

    public function aboutAction(){
        return $this->render('CoreBundle:Core:About.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contacteAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $contacte = new Contacte();
        $contacte->setDestinataire('admin');

        /* l'arrays qui contien mes coordonné*/
        $adress = array(
            'adr_rue'       => 'Comogne de jambes',
            'adr_Num'       => '206',
            'adr_cp'        => '5100',
            'adr_ville'     => 'JAMBES',
            'adr_email_1'   => 'herbale2@hotmail.com',
            'adr_email_2'   => 'darknarke@gmail.com',
            'gsm_num'       => '0472/80.37.75'
        );

        $form = $this->createForm(new ContacteType(), $contacte);
        $mail = null;

        if($user){
            /*
             * si le visiteur est un membre enregistré,
             * on complette les champs pseudo et mail avec ses information.
             */
            $contacte->setAuteur($user->getUsername());
            $contacte->setMail($user->getEmail());
        }

        dump($contacte, $user, $adress);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $em->persist($contacte);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Votre message a bien ete envoyer');

                $From = array($contacte->getMail() => $contacte->getAuteur());
                $To   = array('admin@shensuiprod.esy.es' => 'Administrateur');

                $mail = \Swift_Message::newInstance();
                $mail->setSubject('Formulaire de Contacte_'.$contacte->getDate()->format('d_m_y'));
                $mail->setFrom($From);
                $mail->setTo($To); //remplacer par le compte mail du serveur
                $mail->setCharset('utf-8');
                $mail->setContentType('text/html');
                $mail->setBody($this->renderView('CoreBundle:mail:Contacte_Mail.html.twig', array(
                    'auteur'  => $contacte->getAuteur(),
                    'to'      => 'admin@shensuiprod.esy.es' ,
                    'from'    => $contacte->getMail(),
                    'sujet'   => $mail->getSubject(),
                    'message' => $contacte->getMessage(),
                    'created' => $contacte->getDate(),
                )));
                $this->get('mailer')->send($mail);
            }
        }

        return $this->render('CoreBundle:Core:contacte.html.twig', array(
            'adress' => $adress,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @param $ville
     * @return JsonResponse
     * @throws \Exception
     */
    public function AjaxVilleAction($ville){
        $em = $this->getDoctrine()->getManager();
        $response = new JsonResponse();
        $villes = null;
        /*
         * ajouter les/la fonction pour recupérer les villes
         * via le code postale.
         */

        return $response->setData(array(
            'villes' => $villes
        ));
    }


    public function AnnonceAction(Request $request){
        $session = $request->getSession()->get('result');
        $dispos = $session['list'];
        $nbr = $session['nbr'];
        dump($dispos, $nbr);
        return $this->render('CoreBundle:Core:Annonce.html.twig', array(
            'nbrRes' => $nbr,
            'dispo' => $dispos
        ));
    }

    /**
     * @param User $user
     * @param Contacte $contacte
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ProfilePubAction(User $user, Contacte $contacte, Request $request){
        $em = $this->getDoctrine()->getManager();

        if (!$this->get('security.context')->isGranted('ROLE_MEMBRE')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux membres.');
        }

        $listDispo  = $em->getRepository('UserBundle:Dispo')->findByMembre($user);
        $listAnimal = $em->getRepository('UserBundle:Animals')->findByPropietaire($user);

        //$users = $user  = $em->getRepository('UserBundle:User')->find($user) ;

        $visitor = $this->getUser();
        $message = new Message();
        if($visitor){
            $message->setAuteur($visitor);
        }
        $message->setDestinatair($user);
        $form = $this->createForm(new MessageType(), $message);
        $mail = null;
        dump($message);
        dump($user);
        dump($visitor);
        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $em->persist($message);
                $em->flush();
                $this->redirect($this->generateUrl('Core_Profil', array('id'=> $user->getId(), 'username' => $user->getUsername())));
            }
        }


        return $this->render('CoreBundle:Core:profilePub.html.twig', array(
            'user'   => $user,
            'form'   => $form->createView(),
            'dispo'  => $listDispo,
            'animal' => $listAnimal
        ));
    }

    public function testAction(){
        $em    = $this->getDoctrine()->getManager();
        $user  = $em->getRepository('UserBundle:User')->find('1') ;
        $dispo1 = new Animals();
        $dispo2 = new Animals();
        $dispo1->setName('nala')
               ->setAge('17')
               ->setPropietaire($user)
                ->setSexe('f')
                ->setSantee('De petite probleme de santee')
               ->setType('chat');
        $dispo2->setName('simba')
                ->setSexe('m')
                ->setSantee('Tres bonn santee')
               ->setAge('9')
               ->setPropietaire($user)
               ->setType('chat')
        ;

        $em->persist($dispo1);
        $em->persist($dispo2);
        $em->flush();
        return $this->redirect($this->generateUrl('Core_Profil', array(
            'id' => $user->getId(),
            'username' => $user->getUsername()
        )));
    }
}