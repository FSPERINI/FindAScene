<?php
//Espace Administrateur du site


namespace App\Controller;

use App\Entity\Musiciens;
use App\Entity\Salles;
use App\Form\SallesType;
use App\Repository\SallesRepository;
use App\Repository\MusiciensRepository;
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

    public function __construct(SallesRepository $sallesrepository, MusiciensRepository $musiciensrepository)
    {        
        $this->sallesrepository = $sallesrepository;
        $this->musiciensrepository = $musiciensrepository;
    }


     /**
     * @Route("/admin", name="admin_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
       $salles = $this->sallesrepository->findAll();
       $musiciens = $this->musiciensrepository->findAll();
       return $this->render ("backoff/index.html.twig", compact ('salles', 'musiciens'));
    }

    /**
     * @Route("/admin/{id}", name="admin_edit", methods="GET|POST")
     * @param Salles $salles
     * @param Musiciens $musiciens
     */
    public function edit(Salles $salles, Musiciens $musiciens, Request $request)
    {
        $form = $this->createForm(SallesType::class, $salles);
        
              
        return $this->render('backoff/edit.html.twig', [
        'salle' => $salles,
        'musicien' => $musiciens,
        'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/{id}", name="admin_delete", methods="delete")
     *  @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Salles $salles, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$salles->getId(), $request->get('_token'))) {
            $this->em->remove($salles);
            $this->em->flush();
            $this->addFlash('success', 'Votre annonce a bien été supprimée');
        }
        
        return $this->redirectToRoute('/backoff/index.html.twig');
    }
}