<?php
/**
 * Created by PhpStorm.
 * User: Manon
 * Date: 02-02-16
 * Time: 09:06
 */

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use UserBundle\Entity\User;
use UserBundle\Entity\Message;

class MessageController extends Controller
{
    public function inboxAction(){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $message = $em->getRepository('UserBundle:Message')->isLut('0',$user);

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'messages' => $message,
        ));
    }

    public function outboxAction(Request $request){}

    public function viewAction(){}
}