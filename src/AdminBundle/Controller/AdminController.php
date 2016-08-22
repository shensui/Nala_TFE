<?php
/**
 * Created by PhpStorm.
 * User: Manon
 * Date: 04-03-16
 * Time: 09:42
 */

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;



class AdminController extends Controller
{
    public function DashboardAction(){
        $em = $this->getDoctrine()->getManager();

        $listUser    = $em->getRepository('UserBundle:User')->findAll();
        $listMail    = 0;

        return $this->render('AdminBundle:Admin:Dashboard.html.twig', array(
            'user'      => count($listUser),
            'mail'      => count($listMail),
        ));
    }

    public function ListeAction(){
        $em = $this->getDoctrine()->getManager();

        $lisManga = $em->getRepository('MangaBundle:Manga')->findAll();


        return $this->render('AdminBundle:Manga:Liste.html.twig', array(
            'manga' => $lisManga
        ));
    }

    public function OnlineAction(Manga $manga){
        $em = $this->getDoctrine()->getManager();
        $manga->setOnline('1');
        $em->persist($manga);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_liste'));
    }
}