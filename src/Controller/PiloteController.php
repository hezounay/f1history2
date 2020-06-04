<?php

namespace App\Controller;

use App\Entity\Pilote;
use App\Entity\Team;
use App\Repository\TeamRepository;
use App\Repository\PiloteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PiloteController extends AbstractController
{
    /**
     * @Route("/pilote", name="pilote")
     */
    public function index(PiloteRepository $piloteRepo,TeamRepository $teamRepo)
    {
        return $this->render('pilote/index.html.twig', [
            'pilotes' => $piloteRepo->findAll(),
            'teams' => $teamRepo->findAll()
          
        ]);
    }


 /**
     * @Route("/pilote/{slug}", name="pilote_show")
     *
     * @return Response
     */
    public function show($slug, Pilote $pilote){

        //$ad = $repo->findOneBySlug($slug);

        return $this->render('pilote/show.html.twig',[
          'pilote' => $pilote
        ]);

    }
     }