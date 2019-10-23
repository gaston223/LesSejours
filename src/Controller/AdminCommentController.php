<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\AdminCommentType;
use App\Repository\CommentRepository;
use App\Service\PaginationService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCommentController extends AbstractController
{
    /**
     * @Route("/admin/comments/{page<\d+>?1}", name="admin_comments_index")
     * @param CommentRepository $commentRepository
     * @param $page
     * @param PaginationService $pagination
     * @return Response
     */
    public function index(CommentRepository $commentRepository, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Comment::class)
                    ->setLimit(5)
                    ->setPage($page);
        return $this->render('admin/comment/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'edition du commentaire
     * @param Comment $comment
     * @param Request $request
     * @param ObjectManager $manager
     * @Route("/admin/comments/{id}/edit", name="admin_comments_edit")
     * @return Response
     */
    public function edit(Comment $comment, Request $request, ObjectManager $manager)
    {

        $form=$this->createForm(AdminCommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()){
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire {$comment->getId()} a bien été mofifié! "
            );
        }
        return $this->render('admin/comment/edit.html.twig', [
            'comment'=> $comment,
            'form'=> $form->createView()
        ]);
    }

    /**
     * Permet à l'admin de supprimer un commentaire
     * @param Comment $comment
     * @param ObjectManager $manager
     * @return Response
     * @Route("admin/comments/{id}/delete", name="admin_comments_delete" )
     */
    public function delete(Comment $comment, ObjectManager $manager)
    {
            $manager->remove($comment);
            $manager->flush();

            $this->addFlash('success', "Le commentaire de <strong> {$comment->getAuthor()->getFullName()}</strong> a bien été supprimé");

       return $this->redirectToRoute("admin_comments_index");
    }
}
