<?php

namespace App\Controller;
use App\Entity\Batiment;
use App\Form\BatimentType;
use App\Repository\BatimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BatimentController extends AbstractController
{
    /**
     * @Route("/batiment", name="batiment")
     */
    public function index()
    {
        return $this->render('batiment/index.html.twig', [
            'controller_name' => 'BatimentController',
        ]);
    }
     /**
     * @Route("/batiment/create", name="createbatiment",methods={"POST","GET"})
     */
    public function create(Request $request):Response{
        $batiment=new Batiment();
        $form=$this->createForm(BatimentType::class, $batiment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($batiment);
            $em->flush();
        }
        
        return $this->render('batiment/batiment.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    
}
