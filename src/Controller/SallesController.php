<?php

// Formulaire d'ajout d'une salle


namespace App\Controller;

use App\Entity\Salles;
use App\Form\SallesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SallesController extends AbstractController
{
    /**
     * @Route("/salles/new", name="new_salles")
     */
    public function new(Request $request)
    {
        $salles = new Salles();
        $form = $this->createForm(SallesType::class, $salles);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salles);
            $entityManager->flush();

        }

        return $this->render('salles/new.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}