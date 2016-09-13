<?php
/**
 * Created by PhpStorm.
 * User: Manon
 * Date: 05-09-16
 * Time: 10:01
 */

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Entity\User;

class MembreController extends Controller
{
    public function membre_listAction(){
        $em = $this->getDoctrine()->getManager();

        $membre= $em->getRepository('UserBundle:User')->findAll();

        dump($membre);

        return $this->render("AdminBundle:Membre:List_Membre.html.twig", array(
            'membre' => $membre
        ));
    }

    public function membre_profilAction(User $user){
        $em = $this->getDoctrine()->getManager();

        $listDispo   = $em->getRepository('UserBundle:Dispo')->findByMembre($user);
        $listAnimal  = $em->getRepository('UserBundle:Animals')->findByPropietaire($user);

        return $this->render("AdminBundle:Membre:Profil_membre.html.twig", array(
            'user'   => $user,
            'dispo'  => $listDispo,
            'animal' => $listAnimal
        ));
    }

    public function promoteUserAction(User $user, $role){
        $em     = $this->getDoctrine()->getManager();

        if($user !== null){
            $user_role = $user->getRoles();
            $user->removeRole('ROLE_MODERATEUR');
            $user->addRole($role);
            dump($user_role);
            dump($user);
            dump($role);
            $em->persist($user);
            $em->flush();
            //dump($user, $role);
            return $this->redirect($this->generateUrl('membre_profil', array(
                'id' => $user->getId(),
                'username' => $user->getUsername()
            )));
        }
    }
}