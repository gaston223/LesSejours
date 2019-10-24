<?php

namespace App\Controller;

use App\Repository\AdRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController{

    /**
     * @Route("/", name="homepage")
     *
     * @param AdRepository $adRepository
     * @param UserRepository $userRepository
     * @return Response
     */
    public function home (AdRepository $adRepository, UserRepository $userRepository){
        return $this->render('home.html.twig', [
            'ads' => $adRepository->findBestAds(3),
            'users' =>$userRepository->findBestUsers()
        ]);
    }

}

