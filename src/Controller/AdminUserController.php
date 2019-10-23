<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\User;
use App\Form\AdminBookingType;
use App\Form\AdminUserType;
use App\Repository\UserRepository;
use App\Service\PaginationService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users/{page<\d+>?1}", name="admin_user_index")
     * @param UserRepository $userRepository
     * @param $page
     * @param PaginationService $pagination
     * @return Response
     */
    public function index(UserRepository $userRepository, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(User::class)
                    ->setPage($page);

        return $this->render('admin/user/index.html.twig', [
            'pagination'=>$pagination
        ]);
    }

    /**
     * @param User $user
     * @param ObjectManager $manager
     * @param Request $request
     * @return Response
     * @Route("/admin/user/{id}/edit", name="admin_user_edit")
     */
    public function edit(User $user, ObjectManager $manager, Request $request)
    {
        $form = $this->createForm(AdminUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){

            $manager->flush();
            $this->addFlash('success' ,"L'utilisateur n° {$user->getId()} a bie été modifié ");
            return $this->redirectToRoute("admin_user_index");
        }


        return $this->render('admin/user/edit.html.twig', [
            'form' =>$form->createView(),
            'user' =>$user
        ]);
    }


    /**
     * Supprimer un Utilisateur
     * @Route("/admin/user/{id}/delete", name="admin_user_delete")
     * @param User $user
     * @param ObjectManager $manager
     * @return RedirectResponse
     */
    public function delete(User $user, ObjectManager $manager)
    {
        if (count($user->getBookings())>0 or($user->getComments()>0)){
            $this->addFlash('warning', "Vous ne pouvez pas supprimer L'utilisateur <strong>{$user->getFullName()}</strong> car il possède déja des réservations ou des commentaires");
        } else{$manager->remove($user);
            $manager->flush();
            $this->addFlash('success', "L'utilisateur a bien été supprimé");}


        return $this->redirectToRoute("admin_user_index");
    }

}
