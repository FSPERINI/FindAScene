<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Form\ManagerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ManagerController extends AbstractController
{
    /**
     * @Route("/manager/new", name="new_manager")
     */
    public function new(Request $request, SluggerInterface $slugger)
    {
        $manager = new Manager();
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $manager->setSlug($slugger->slug($manager->getName())->lower());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($manager);
            $entityManager->flush();
            $this->addFlash('success', 'Votre compte a bien été créé');
            return $this->redirectToRoute('home/home.html.twig');
        }

        return $this->render('manager/new.html.twig',[
            'manager' => $manager,
            'form'=> $form->createView()
        ]);
    }
    /**
     * @Route ("/manager/profile", name="profile_manager")
     */
    public function profile()
    {
        return $this->render('manager/profile.html.twig',[
            'profile'=> $profile->createView()
        ]);
    }
}