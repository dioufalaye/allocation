<?php

namespace App\Controller;
use App\Entity\Etudiants;
use App\Form\EtudiantsType;
use App\Repository\EtudiantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantsController extends AbstractController

{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('etudiants/home.html.twig');
    }
    /**
     * @Route("/etudiants", name="etudiants")
     */
    public function index()
    {
        return $this->render('etudiants/index.html.twig', [
            'controller_name' => 'EtudiantsController',
        ]);
    }
     /**
     * @Route("/etudiants/create", name="createetudiants",methods={"POST","GET"})
     */
    public function create(Request $request,EtudiantsRepository $ripo):Response{
        $recup=$ripo->findAll();
        $nombre=count($recup);
        $etudiants=new Etudiants();
        $form=$this->createForm(EtudiantsType::class,  $etudiants);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $nom=$etudiants->getNom();
            $prenom=$etudiants->getPrenom();
            $matricule=$this->generate($nombre+1,$nom,$prenom);
            $etudiants->setMatricule($matricule);
            //recuperation numero matricule 
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiants);
            $em->flush();
        }
        
        return $this->render('etudiants/etudiants.html.twig',[
            'form'=> $form->createView()
        ]);
    }
 /**
     * @Route("/etudiants/addetudiants", name="addetudiants")
     */
    public function addetudiants() {
        return $this->render('etudiants/eudiants.html.twig');
    }
    public function generateNumber($number){
        if (preg_match("# [0-9]{4}#",$number)) {
            return $number;
        }else {
            $newNumber = (string)$number;
            $long = strlen($newNumber);
            if ($long<4) {
                $restant = 4-$long;
                for ($i=0; $i <$restant ; $i++) { 
                    $number = "0".$number;
                }
                return $number;
            } 
        }


    }
    public function generate($num, $n, $p) {
        $date= new   \DateTime;
        $annee= $date->format('Y');
        $string1=substr($n,0,2);
        $string2=substr($p,0,2);
        $nombre=$this->generateNumber($num);
        return  $annee.strtoupper($string1).strtoupper($string2).$nombre;
    }
    /**
     * @Route("/chambre/listeretudiants", name="listeretudiants")
     */
    public function lister(EtudiantsRepository $etudiantsRepository, PaginatorInterface $paginator, Request $request)
    {
        $etudiants = $etudiantsRepository->findAll();
        $pagination = $paginator->paginate(
            $etudiants,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('etudiants/listeretudiants.html.twig', [/* compact("chambres") */
            'etudiants' => $pagination
        ]);
    }
    /**
     * @Route("/chambre/{id<[0-9]+>}/deleteroom", name="deleteroom")
     */
    public function deleteroom(EntityManagerInterface $em, Etudiants $etudiants)
    {
        //dd($chambre);
        $em->remove($etudiants);
        $em->flush();
        return $this->redirectToRoute('listeretudiants');
    }
    /**
    * @Route("/chambre/{id<[0-9]+>}/updateroom", name="updateroom", methods={"POST","GET"})
    */
    public function updateroom( Request $request, EntityManagerInterface $em, Etudiants $etudiants) :Response{
        /* $chambre = new Chambre(); */
        $form= $this->createForm(EtudiantsType::class, $etudiants);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /* $em->persist($chambre); */
            $em->flush();
            return $this->redirectToRoute('listeretudiants');
        }

        return $this->render('etudiants/etudiants.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
