<?php

namespace App\Controller;

use App\Entity\Stats;
use App\Entity\Pilote;
use App\Entity\GrandPrix;
use App\Repository\TeamRepository;
use App\Repository\StatsRepository;
use App\Repository\PiloteRepository;
use App\Repository\GrandPrixRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GrandPrixController extends AbstractController
{
    /**
     * @Route("/grandprix/", name="grandprix")
     * @param Stats $stats
     */
    public function index(GrandPrixRepository $grandPrixRepo, StatsRepository $repo)
    {
      
      
 

        return $this->render('grand_prix/index.html.twig', [
            'grandprix' => $grandPrixRepo->findAll(),
   
            
          
        ]);
    }
    /**
     * @Route("/grandprix/_2016", name="_2016")
     * @param Stats $stats
     */
    public function index_2016(GrandPrixRepository $grandPrixRepo, StatsRepository $repo)
    {
      
      
 

        return $this->render('grand_prix/_2016.html.twig', [
            'grandprix' => $grandPrixRepo->findAll(),
   
            
          
        ]);
    }
         /**
     * @Route("/grandprix/_2017", name="_2017")
     * @param Stats $stats
     */
    public function index_2017(GrandPrixRepository $grandPrixRepo, StatsRepository $repo)
    {
      
      
 

        return $this->render('grand_prix/_2017.html.twig', [
            'grandprix' => $grandPrixRepo->findAll(),
   
            
          
        ]);
    }
      /**
     * @Route("/grandprix/_2018", name="_2018")
     * @param Stats $stats
     */
    public function index_2018(GrandPrixRepository $grandPrixRepo, StatsRepository $repo)
    {
      
      
 

        return $this->render('grand_prix/_2018.html.twig', [
            'grandprix' => $grandPrixRepo->findAll(),
   
            
          
        ]);
    }
     /**
     * @Route("/grandprix/_2019", name="_2019")
     * @param Stats $stats
     */
    public function index_2019(GrandPrixRepository $grandPrixRepo, StatsRepository $repo)
    {
      
      
 

        return $this->render('grand_prix/_2019.html.twig', [
            'grandprix' => $grandPrixRepo->findAll(),
   
            
          
        ]);
    }




 /**
     * @Route("/grandprix/{slug}", name="grandprix_show")
     *
     * @return Response
     */
    public function show($slug, GrandPrix $grandPrix, GrandPrixRepository $grandPrixRepo, StatsRepository $repo){

        $stats = $repo->myOrderStats($slug, 'ASC');
        

        return $this->render('grand_prix/show.html.twig', [
            'grandprix' => $grandPrix,
            'myStats' => $stats
           
            
          
        ]);
    }
  

     }