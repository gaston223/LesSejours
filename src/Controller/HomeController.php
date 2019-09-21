<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends Controller{

    /**
     * @Route("/", name="homepage")
     *
     * @return void
     */
    public function home (){
        $prenoms=["Lior" =>31, "Joseph"=>12, "Anne"=>55];
    return $this->render('home.html.twig', 
    [
        'title'=>"Au revoir",
        'age'=>31,
        'tableau'=>$prenoms

        ]);
    }

}

?>