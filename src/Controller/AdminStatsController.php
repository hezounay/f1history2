<?php

namespace App\Controller;

use App\Entity\Stats;
use App\Entity\Pilote;
use App\Form\StatsType;
use App\Entity\GrandPrix;
use App\Service\PaginationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminStatsController extends AbstractController
{
      /**
     * 
     * @Route("/admin/stats/{page<\d+>?1}", name="admin_stats_index")
     */
    public function index($page, PaginationService $pagination )
    {
     
        $pagination->setEntityClass(Stats::class)
        ->setPage($page)
        ->setLimit(10)
        ->setRoute('admin_stats_index');

        /* return $this->render('admin/stats/index.html.twig', [
            'controller_name' => 'AdminStatsController',
            ]); */  

        return $this->render('admin/stats/index.html.twig',[
            'pagination' => $pagination
        ]);
    }   
    /**
     * Permet d'afficher le formulaire d'édition
     * @Route("/admin/stats/{id}/edit", name="admin_stats_edit")
     * 
     * @param Stats $stats
     * @param Pilote $pilote
     * @param GrandPrix $grandprix
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(Stats $stats, Pilote $pilote, GrandPrix $grandprix, Request $request, EntityManagerInterface $manager){
        $form = $this->createForm(StatsType::class, $stats);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($stats);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les Statistiques de <strong></strong> au <strong></strong> en ont bien été modifiées"
            );
        }

        return $this->render('admin/stats/edit.html.twig',[
            'stats' => $stats,
            'pilote' => $pilote,
            'grandprix' => $grandprix,
            'myForm' => $form->createView()
            
        ]);


    }
    /**
     * Permet de créer des Statistiques
     * @Route("/admin/stats/new", name="admin_stats_create")
     * 
     * 
     * @param Pilote $pilote
     * @param GrandPrix $grandprix
     * @param Request $request
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $stats = new Stats();
       
        $form = $this->createForm(StatsType::class,$stats);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

        $chrono=$stats->getChrono();
        $chronohour=$chrono/3600000;
        $chronominutes=$chrono/60000;
        $chronoseconds=$chrono/1000;
        $chronomilliseconds=$chrono;
        $chronoTot= $chronohour.':'.$chronominutes."'".$chronoseconds.".".$chronomilliseconds;
         //  $chrono=$stats->getChrono();
         //  $chronohour=str_split(":",$chrono)[0];
        //   $chronominutes=str_split("'",str_split(":",$chrono)[1])[0];
        //   $chronoseconds=str_split(".",str_split("'",str_split(":",$chrono)[1])[1])[0];
        //   $chronomilliseconds=str_split(".",str_split("'",str_split(":",$chrono)[1])[1])[1];
        //   dd($chronohour.'-'.$chronominutes.'-'.$chronoseconds.'-'. $chronomilliseconds);

        //    $chronotot= $chronohour.':'.$chronominutes."'".$chronoseconds.".".$chronomilliseconds;

            $manager->persist($stats);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les Statistiques de <strong>X</strong> au <strong>X</strong> en X ont bien été enregistrées ! "
            );

            return $this->redirectToRoute('admin_stats_index',[
                'slug' => $stats->getSlug(),
                'chrono'=> $chronoTot
            ]);
        }

        return $this->render('admin/stats/new.html.twig', [
           'myForm' => $form->createView(),
           

        ]);

    }
    /**
     * Permet de supprimer des Statistiques
     * @Route("/admin/stats/{id}/delete", name="admin_stats_delete")
     *
     * @param Stats $stats
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Stats $stats, Pilote $pilote, GrandPrix $grandprix, Request $request, EntityManagerInterface $manager){
        // on ne peut pas supprimer une annonce qui possède des Statistiques 
        
        {
            $manager->remove($stats);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les Statistiques de <strong>X</strong> au <strong>X</strong> en X ont bien été supprimées"
            );
        }

        return $this->redirectToRoute('admin_stats_index');

    }

}
