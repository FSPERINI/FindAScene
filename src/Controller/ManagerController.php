<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Form\ManagerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/manager")
 */
class ManagerController extends AbstractController
{
    /**
     * @Route ("/", name="home_manager")
     */
    public function index()
    {
        return $this->render('manager/index.html.twig'   
        );
    }


    /**
     * @Route("/manager/new", name="new_manager")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, SluggerInterface $slugger)
    {
        $manager = new Manager();
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($manager, $manager->getPlainPassword());
            $manager->setPassword($password);
            $manager->setIsActive(true);
            $manager->addRole("ROLE_MANAGER");
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
     * @Route("/manager/profil/edit{id}", name="edit_manager", methods="GET|POST")
     * @param Manager $manager
     */
    public function edit(Manager $manager, Request $request)
    {
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Les infos ont bien été modifiées');
            return $this->redirectToRoute('manager.profil');
        }       
        return $this->render('manager/edit.html.twig', [
        'manager' => $manager,
        'form' => $form->createView()
        ]);
    }

    
}