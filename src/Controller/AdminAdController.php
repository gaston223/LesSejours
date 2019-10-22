<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AnnonceType;
use App\Repository\AdRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads", name="admin_ads_index")
     * @param AdRepository $adRepository
     * @return Response
     */
    public function index(AdRepository $adRepository)
    {
        return $this->render('admin/ad/index.html.twig', [
            'ads' => $adRepository->findAll(),
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'edition
     * @param Ad $ad
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     * @Route("/admin/ads/{id}/edit", name="admin_ads_edit")
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager)
    {
        $form=$this->createForm(AnnonceType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()){
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce {$ad->getTitle()} a bien été enregistrée ! "
            );
        }

        return $this->render('admin/ad/edit.html.twig',[
            'ad'=>$ad,
            'form'=> $form->createView()
        ]);

    }

    /**
     * Permet à l'admin de supprimer une annonce
     * @param Ad $ad
     * @param ObjectManager $manager
     * @Route("/admin/ads/{id}/delete", name="admin_ads_delete")
     * @return RedirectResponse
     */
    public function delete(Ad $ad, ObjectManager $manager)
    {
        if (count($ad->getBookings())>0){
            $this->addFlash('warning', "Vous ne pouvez pas supprimer l'annonce <strong>{$ad->getTitle()}</strong> car elle possède déja des réservations");
        } else {
            $manager->remove($ad);
            $manager->flush();

            $this->addFlash('success', "L'annonce <strong> {$ad->getTitle()}</strong> a bien été supprimée");
        }
        return $this->redirectToRoute("admin_ads_index");
    }
    
}
