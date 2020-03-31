<?php

namespace App\Controller;

use App\Form\SallesType;
use App\Entity\Salles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


class SallesController extends AbstractController
{
    /**
     * @Route("/salles/new", name="new_salles")
     */
    public function new(Request $request, SluggerInterface $slugger)
    {
        $salles = new Salles();
        $form = $this->createForm(SallesType::class, $salles);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){

            $salles->setSlug($slugger->slug($salles->getNomSalle())->lower());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salles);
            $entityManager->flush();

        }

        return $this->render('salles/new.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/salles/show/{slug}", name="show_salles")
     */

     public function show($slug){
         
        $salles = $this->getDoctrine()->getRepository(Salles::class)->findOneBy(['slug'=>$slug]);

        return $this->render('salles/show.html.twig', [
            'salle' => $salles,
        ]);
     }
}