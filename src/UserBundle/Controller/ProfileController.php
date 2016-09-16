<?php

/**
 * Created by PhpStorm.
 * User: Manon
 * Date: 30-01-16
 * Time: 09:58
 */

namespace UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Controller\ProfileController as BaseProfil;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;

use UserBundle\Entity\Animals;
use UserBundle\Entity\Dispo;
use UserBundle\Entity\User;

use UserBundle\Entity\Message;
use UserBundle\Form\AnimalsType;
use UserBundle\Form\DispoType;
use UserBundle\Form\MessageType;


class ProfileController extends BaseProfil
{
    /*
     * method show ne marche pas, fomulaire en post non soumis.
     * token crf non valide??
     * */

    public function indexAction(){
        $em = $this->getDoctrine();

        return $this->render('UserBundle:Membre:index.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function showAction()
    {
        $em   = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        //$animal = new Animals();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /*ajout des donnée dans le profil*/
        $listDispo   = $em->getRepository('UserBundle:Dispo')->findByMembre($user);
        $listAnimal  = $em->getRepository('UserBundle:Animals')->findByPropietaire($user);
        //$message     = $em->getRepository('UserBundle:Message')->isLut('0',$user);
        $message     = $em->getRepository('UserBundle:Message')->findBy(['destinatair' => $user],['lut' => 'ASC']);
        $count       = $em->getRepository('UserBundle:Message')->isLut('0',$user);
        dump($message, $count);
        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user'        => $user,
            'dispo'       => $listDispo,
            'animal'      => $listAnimal,
            'nbr'         => count($count),
            'messages'    => $message,
        ));
    }

    public function dispo_addAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $dispo = new Dispo();
        $dispo->setMembre($user);
        $dispo->setVille($user->getAdrVille());
        $form  = $this->createForm(new DispoType(), $dispo);

        dump($request->getMethod());
        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $em->persist($dispo);
                $em->flush();
                return $this->redirect($this->generateUrl('fos_user_profile_show'));
            }
        }
        return $this->render('UserBundle:Membre:dispo_add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function animal_AddAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $animal = new Animals();
        $animal->setPropietaire($user);
        $form  = $this->createForm(new AnimalsType(), $animal);

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $em->persist($animal);
                $em->flush();
                /*la redirection ne fonctionne pas...*/
                return $this->redirect($this->generateUrl('fos_user_profile_show'));
            }
        }

        return $this->render('UserBundle:Membre:animal_add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function promoteUserAction(User $user, $roles){
        $em     = $this->getDoctrine()->getManager();
        $user   = $em->getRepository('SOUserBundle:User')->find($user);

        if($user !== null){
            $user->addRole($roles);

            $em->persist($user);
            $em->flush();
            //dump($user);
        }
    }

    public function ajax_messageAction($lut){
        $em = $this->getDoctrine()->getManager();
        $response = new JsonResponse();

        $luts = $em->getRepository('UserBundle:Message')
            ->findOneBy(array('id' => $lut));

        if($luts && $luts->getLut == 0){
            $luts->setLut('1');
            $em->persist($luts);
            $em->flush();
            $rep = 'le message a ete lut';
        }else{
            $rep = 'il y a eu une erreurs';
        }

        return $response->setData(array(
            'rep' => $rep
        ));
    }
}