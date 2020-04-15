<?php

namespace App\Controller;

use App\Entity\Musiciens;
use App\Entity\User;
use App\Form\MusiciensType;
use App\Form\UserType;
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
        return $this->render('musiciens/show.html.twig', [
            'user' => $this->getUser(),
        ]);
    }


    /**
     * @Route("/new", name="new_musiciens")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, SluggerInterface $slugger)
    {
        $musiciens = new Musiciens();
        $form = $this->createForm(MusiciensType::class, $musiciens);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($musiciens, $musiciens->getPassword());
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
     * @Route("/edit/{id}", name="edit_musiciens", methods="GET|POST")
     * @param Musiciens $musiciens
     */
    public function edit(Musiciens $musiciens, Request $request)
    {
        $form = $this->createForm(MusiciensType::class, $musiciens);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Les infos ont bien été modifiées');
            return $this->redirectToRoute('edit_musiciens');
        }       
        return $this->render('Musiciens/edit.html.twig', [
        'musiciens' => $musiciens,
        'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profil", name="profil_musiciens", methods="GET|POST")
     * @param Musiciens $musiciens
     */
    public function profil(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getUser();

        if ($user instanceof User) {
            $form = $this->createForm(UserType::class, $user);
        } else if ($user instanceof Musiciens) {
            $form = $this->createForm(MusiciensType::class, $user);
        }

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Les infos ont bien été modifiées');
            return $this->redirectToRoute('profil_musiciens');
        }       
        return $this->render('Musiciens/edit.html.twig', [
        'user' => $user,
        'form' => $form->createView()
        ]);
    }

    
}