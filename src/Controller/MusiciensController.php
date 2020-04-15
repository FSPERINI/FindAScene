<?php

namespace App\Controller;

use App\Entity\Musiciens;
use App\Form\MusiciensType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/musiciens")
 */
class MusiciensController extends AbstractController
{
    /**
     * @Route ("/", name="home_musiciens")
     */
    public function index()
    {
        return $this->render('musiciens/index.html.twig'   
        );
    }


    /**
     * @Route("/musiciens/new", name="new_musiciens")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, SluggerInterface $slugger)
    {
        $musiciens = new Musiciens();
        $form = $this->createForm(MusiciensType::class, $musiciens);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($musiciens, 'demo');
            $musiciens->setPassword($password);
            $musiciens->setIsActive(true);
            $musiciens->addRole(['ROLE_MUSICIENS']);
            $musiciens->setSlug($slugger->slug($musiciens->getName())->lower());
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($musiciens);
            $entityManager->flush();
            
            $this->addFlash('success', 'Votre compte a bien été créé');
            return $this->render('home/home.html.twig');
        }

        return $this->render('musiciens/new.html.twig',[
            'musiciens' => $musiciens,
            'form'=> $form->createView()
        ]);
    }
    
    /**
     * @Route("/musiciens/profil/edit/{id}", name="edit_musiciens", methods="GET|POST")
     * @param Musiciens $musiciens
     */
    public function edit(musiciens $musiciens, Request $request)
    {
        $form = $this->createForm(MusiciensType::class, $musiciens);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Les infos ont bien été modifiées');
            return $this->redirectToRoute('Musiciens.profil');
        }       
        return $this->render('Musiciens/edit.html.twig', [
        'musiciens' => $musiciens,
        'form' => $form->createView()
        ]);
    }

    
}