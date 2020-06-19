<?php

namespace App\Controller;

use App\Entity\Team;

use App\Form\TeamType;
use App\Form\PiloteType;
use App\Entity\TeamPhotoEdit;
use App\Form\TeamPhotoEditType;
use App\Service\PaginationService;
use App\Repository\PiloteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AdminTeamController extends AbstractController
{
    /**
     * @Route("/admin/team/{page<\d+>?1}", name="admin_team_index")
     */
    public function index($page, PaginationService $pagination)
    
    
    {
        
     
        $pagination->setEntityClass(Team::class)
        ->setPage($page)
        ->setLimit(10)
        ->setRoute('admin_team_index');

   
        return $this->render('admin/team/index.html.twig',[
            'pagination' => $pagination,
            
        ]);



     




    }

     /**
     * Permet d'afficher le formulaire d'édition
     * @Route("/admin/team/{id}/edit", name="admin_team_edit")
     *
     * @param Team $team
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(Team $team, Request $request, EntityManagerInterface $manager){
        $form = $this->createForm(TeamType::class,$team);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($team);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$team->getNom()}</strong> a bien été modifiée"
            );
        
        }

        return $this->render('admin/team/edit.html.twig',[
            'team' => $team,
            'myForm' => $form->createView()
        ]);


    }

     /**
     * Permet de supprimer une Ecurie
     * @Route("/admin/team/{id}/delete", name="admin_team_delete")
     *
     * @param Team $team
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Team $team, EntityManagerInterface $manager){
        // on ne peut pas supprimer une team qui possède des Pilotes 
       
        {
            $manager->remove($team);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'écurie &nbsp <strong>{$team->getNom()}</strong> a bien été supprimée"
            );
        }

        return $this->redirectToRoute('admin_team_index');

    }
      /**
     * Permet de créer une Ecurie
     * @Route("/admin/team/new", name="admin_team_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $team = new Team();
       
        $form = $this->createForm(TeamType::class, $team);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


            $file = $form['cover']->getData();
        
            if(!empty($file)){
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
                try{
                   $file->move(
                       $this->getParameter('uploads_directory'),
                       $newFilename
                   ); 
                }catch(FileException $e){
                    return $e->getMessage();
                }
                $team->setCover($newFilename);
            }

            $manager->persist($team);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'Ecurie &nbsp<strong>{$team->getNom()}</strong> a bien été enregistrée ! "
            );

            return $this->redirectToRoute('admin_team_index',[
                'slug' => $team->getSlug()
            ]);
        }

        return $this->render('admin/team/new.html.twig', [
           'myForm' => $form->createView()
        ]);

    }


     /**
     * Permet d'afficher le formulaire d'édition de la photo
     * @Route("/admin/team/{id}/edit/photo", name="admin_team_edit_photo")
     * @param Team $team
     */
    public function editPhoto(Team $team, Request $request, EntityManagerInterface $manager)
    {
        $team2 = new TeamPhotoEdit();
        $form = $this->createForm(TeamPhotoEditType::class,$team2);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){   
         
            $file = $form['cover']->getData();
          
           
            if(!empty($file)){
                $cover=$team->getCover();
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
                try{
                   $file->move(
                       $this->getParameter('uploads_directory'),
                       $newFilename
                   ); 
                }catch(FileException $e){
                    return $e->getMessage();
                }
                $team->setCover($newFilename);
                if(!empty($cover)){

                    unlink($this->getParameter("uploads_directory")."/".$cover);
                }
  
            }
           

            $manager->persist($team);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'écurie a bien été modifié"
            );
            return $this->redirectToRoute("admin_team_index");
        }

        return $this->render('admin/team/editPhoto.html.twig',[
            'team' => $team,
            'myForm' => $form->createView()
        ]);
        
    }
    
}

