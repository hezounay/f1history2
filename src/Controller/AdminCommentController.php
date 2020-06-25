<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentType;
use App\Service\PaginationService;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCommentController extends AbstractController
{
    /**
     * @Route("/admin/comments/{page<\d+>?1}", name="admin_comment_index")
     */
    public function index($page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Comments::class)
                ->setPage($page)
                ->setLimit(500)
                ;  

        return $this->render('admin/comment/index.html.twig', [
           'pagination' => $pagination
        ]);
    }

    /**
     * Permet de modifier un commentaire
     * @Route("/admin/comments/{id}/edit", name="admin_comment_edit")
     *
     * @param Comments $comment
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(Comments $comment, Request $request, EntityManagerInterface $manager){
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire n°<strong>{$comment->getId()}</strong> a été modifié"
            );
        }

        return $this->render('admin/comment/edit.html.twig',[
            'comment' => $comment,
            'myForm' => $form->createView()
        ]);

    }

    /**
     * Permet de supprimer un commentaire
     * @Route("/admin/comments/{id}/delete", name="admin_comment_delete")
     *
     * @param Comments $comment
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Comments $comment, EntityManagerInterface $manager){
        
        $manager->remove($comment);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le commentaire a bien été supprimée"
        );

        return $this->redirectToRoute('admin_comment_index');
    }
}
