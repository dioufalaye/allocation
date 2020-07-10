<?php

namespace App\Controller;
use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChambreController extends AbstractController
{
    /**
     * @Route("/chambre", name="chambre")
     */
    public function index()
    {
        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }
     /**
     * @Route("/chambre/create", name="createchambre",methods={"POST","GET"})
     */
    public function create(Request $request, EntityManagerInterface $em):Response{
        $rp= $em->getRepository(Chambre::class);
        $nbrField=count($rp->findAll());
        $chambre=new Chambre();
        $form=$this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           // $numbatiment=$chambre->getBatiment()->getId();
            //$genere=$this->generateNumchambre($numbatiment, $numbatiment);
            //$chambre->setBatiment($genere);
           // $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();
        }
        
        return $this->render('chambre/chambre.html.twig',[
            'form'=> $form->createView(),
            'nbrField' => $nbrField
        ]);
    }
    /**
     * @Route("/chambre/addchambre", name="addchambre")
     */
    public function addchambre() {
        return $this->render('chambre/chambre.html.twig');
    }
     
    /*public function generate($number){
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
    public function generateNumchambre($number, $number1)
    {
        $number=$this->generate($number);
        return $number1.$number;

    }*/
    /**
     * @Route("/chambre/listerchambre", name="listerchambre")
     */
    public function lister(ChambreRepository $chambreRepository, PaginatorInterface $paginator, Request $request)
    {
        $chambres = $chambreRepository->findAll();
        $pagination = $paginator->paginate(
            $chambres,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('chambre/listerchambre.html.twig', [/* compact("chambres") */
            'chambres' => $pagination
        ]);
    } 

    /**
     * @Route("/chambre/{id<[0-9]+>}/deleteroom", name="deleteroom")
     */
    public function deleteroom(EntityManagerInterface $em, Chambre $chambre)
    {
        //dd($chambre);
        $em->remove($chambre);
        $em->flush();
        return $this->redirectToRoute('listerchambre');
    }

    /**
    * @Route("/chambre/{id<[0-9]+>}/updateroom", name="updateroom", methods={"POST","GET"})
    */
    public function updateroom( Request $request, EntityManagerInterface $em, Chambre $chambre) :Response{
        /* $chambre = new Chambre(); */
        $form= $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /* $em->persist($chambre); */
            $em->flush();
            return $this->redirectToRoute('listerchambre');
        }

        return $this->render('chambre/chambre.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
