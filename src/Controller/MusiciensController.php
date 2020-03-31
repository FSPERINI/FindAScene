<?php

namespace App\Controller;

use App\Entity\Musiciens;
use App\Form\MusiciensType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MusiciensController extends AbstractController
{
    /**
     * @Route("/musiciens/new", name="new_musiciens")
     */
    public function new(Request $request)
    {
        $musiciens = new Musiciens();
        $form = $this->createForm(MusiciensType::class, $musiciens);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($musiciens);
            $entityManager->flush();

        }

        return $this->render('musiciens/new.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
