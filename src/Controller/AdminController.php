<?php
//Espace Administrateur du site


namespace App\Controller;

use App\Entity\Musiciens;
use App\Entity\Salles;
use App\Form\MusiciensType;
use App\Form\SallesType;
use App\Repository\SallesRepository;
use App\Repository\MusiciensRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @var SallesRepository
     */
    private $sallesrepository;
    /**
     * @var MusiciensRepository
     */
    private $musiciensrepository;

    public function __construct(SallesRepository $sallesrepository, MusiciensRepository $musiciensrepository, EntitymanagerInterface $em)
    {        
        $this->sallesrepository = $sallesrepository;
        $this->musiciensrepository = $musiciensrepository;
        $this->em = $em;
    }


     /**
     * @Route("/admin", name="admin_index")
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
       $salles = $this->sallesrepository->findAll();
       $musiciens = $this->musiciensrepository->findAll();
       return $this->render ("backoff/index.html.twig", compact ('salles', 'musiciens'));
    }

    /**
     * @Route("/admin/edit{id}", name="admin_edit", methods="GET|POST")
     * @param Salles $salles
     */
    public function edit(Salles $salles, Request $request)
    {
        $form = $this->createForm(SallesType::class, $salles);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Les infos ont bien été modifiées');
            return $this->redirectToRoute('admin_index');
        }

        return $this->render('backoff/edit.html.twig', [
        'salle' => $salles,
        'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/{id}", name="admin_delete", methods="delete")
     *  @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Salles $salles, musiciens $musiciens, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$salles->getId(), $request->get('_token'))) {
            $this->em->remove($salles);
            $this->em->flush();
            $this->addFlash('success', 'Le lieu ou l\'\utilisateur a bien été supprimé');
        }
        
        return $this->redirectToRoute('/backoff/index.html.twig');
    }
}