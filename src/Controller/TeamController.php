<?php

namespace App\Controller;

use App\Entity\Pilote;
use App\Entity\Team;
use App\Repository\TeamRepository;
use App\Repository\PiloteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamController extends AbstractController
{
    /**
     * @Route("/team", name="team")
     */
    public function index(PiloteRepository $piloteRepo,TeamRepository $teamRepo)
    {
        return $this->render('team/index.html.twig', [
            'pilotes' => $piloteRepo->findAll(),
            'teams' => $teamRepo->findAll()
          
        ]);
    }


 /**
     * @Route("/team/{slug}", name="team_show")
     *
     * @return Response
     */
    public function show($slug, Team $team, TeamRepository $repo){

   
        

        return $this->render('team/show.html.twig',[
          'team' => $team,
         
        ]);
    }
     }