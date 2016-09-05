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

        return $this->render();
    }
}