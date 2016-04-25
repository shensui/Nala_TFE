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

use MangaBundle\Entity\Manga;

class AdminController extends Controller
{
    public function DashboardAction(){
        $em = $this->getDoctrine()->getManager();

        $listManga   = $em->getRepository('MangaBundle:Manga')->findAll();
        $listUser    = $em->getRepository('UserBundle:User')->findAll();
        $listComment = $em->getRepository('MangaBundle:Commentaire')->findAll();
        $genre       = $em->getRepository('CoreBundle:Genre')->findAll();
        $type        = $em->getRepository('CoreBundle:Type')->findAll();

        $youtube=array(/*a modifier apres creation table media*/
            ['id'    =>'01',
                'title' => 'my playliste',
                'src'   => 'mwUkkl8iEzc?list=PLIHb2oXL94VrO6lIprvKRmw3t0xtsSVUY'
            ],['id'    =>'02',
                'title' => 'one piece full openine',
                'src'   => 'ICZp95KZGMM'
            ],['id'    =>'03',
                'title' => 'one piece full openine',
                'src'   => 'FLwXW-5xuhA?list=PLi9Zx4W6pHMLUcjb1v7VwF8n_rr5Zke7l'
            ]
        );


        foreach($genre as $genre){
            $statGenre[$genre->getName()] = count($em->getRepository('MangaBundle:Manga')->SearchGenre($genre->getName()));
        }
        foreach($type as $type){
            $statType[$type->getName()]   = count($em->getRepository('MangaBundle:Manga')->SearchType($type->getName()));
        }

        return $this->render('AdminBundle:Admin:Dashboard.html.twig', array(
            'manga'     => count($listManga),
            'user'      => count($listUser),
            'comment'   => count($listComment),
            'types'     => $type,
            'statType'  => $statType,
            'statGenre' => $statGenre,
            'video'     => $youtube
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