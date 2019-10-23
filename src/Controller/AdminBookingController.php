<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\AdminBookingType;
use App\Repository\BookingRepository;
use App\Service\PaginationService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookingController extends AbstractController
{
    /**
     * Affiche la liste des réservations
     * @Route("/admin/bookings/{page<\d+>?1}", name="admin_booking_index")
     * @param BookingRepository $bookingRepository
     * @param $page
     * @param PaginationService $pagination
     * @return Response
     */
    public function index(BookingRepository $bookingRepository, $page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Booking::class)
                    ->setPage($page);

        return $this->render('admin/booking/index.html.twig', [
            'pagination'=>$pagination
        ]);
    }

    /**
     * @param Booking $booking
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     * @Route("/admin/booking/{id}/edit", name="admin_booking_edit")
     */
    public function edit(Booking $booking, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(AdminBookingType::class, $booking);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $booking->setAmount(0);
           $manager->flush();
           $this->addFlash('success' ,"La réservation n° {$booking->getId()} a bie été modifiée ");
           return $this->redirectToRoute("admin_booking_index");
        }

        return $this->render('admin/booking/edit.html.twig', [
            'form'=> $form->createView(),
            'booking'=>$booking
        ]);
    }

    /**
     * Supprimer une réservation
     * @Route("/admin/bookings/{id}/delete", name="admin_booking_delete")
     * @param Booking $booking
     * @param ObjectManager $manager
     * @return RedirectResponse
     */
    public function delete(Booking $booking, ObjectManager $manager)
    {
        $manager->remove($booking);
        $manager->flush();
        $this->addFlash('success', "La réservation a bien été supprimée");

        return $this->redirectToRoute("admin_booking_index");
    }

}
