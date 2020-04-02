<?php

namespace App\Controller;

use App\Entity\Musiciens;
use App\Form\MusiciensType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class MusiciensController extends AbstractController
{
    /**
     * @Route("/musiciens/new", name="new_musiciens")
     */
    public function new(Request $request,  SluggerInterface $slugger)
    {
        $musiciens = new Musiciens();
        $form = $this->createForm(MusiciensType::class, $musiciens);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){

            $musiciens->setSlug($slugger->slug($musiciens->getNomGrp())->lower());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($musiciens);
            $entityManager->flush();

        }

        return $this->render('musiciens/new.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/musiciens/profil/edit/{slug}", name="edit_musiciens")
     */

     public function edit(Request $request, Musiciens $musiciens)
     {

        $form = $this->createForm(MusiciensType::class, $musiciens);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
       
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('musiciens/edit.html.twig', [
            'form' => $form->createView(),
        ]);

        


     }
}
