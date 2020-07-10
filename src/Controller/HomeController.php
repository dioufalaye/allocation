<?php

namespace App\Controller;
use App\Form\BatimentType;
use App\Repository\BatimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/home/addchambre", name="addchambre")
     */
    public function addchambre() {
        return $this->render('home/chambre.html.twig');
    }
    /**
     * @Route("/home/addbatiment", name="addbatiment")
     */
    public function addbatiment() {
        return $this->render('home/batiment.html.twig');
    }
    
}
