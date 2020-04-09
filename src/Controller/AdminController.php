<?php
//Espace Administrateur du site


namespace App\Controller;

use App\Entity\Manager;
use App\Entity\Salles;
use App\Form\SallesType;
use App\Repository\SallesRepository;
use App\Repository\ManagerRepository;
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
     * @var ManagerRepository
     */
    private $managerrepository;

    public function __construct(SallesRepository $sallesrepository, ManagerRepository $managerrepository, EntityManagerInterface $em)
    {        
        $this->sallesrepository = $sallesrepository;
        $this->managerrepository = $managerrepository;
        $this->em = $em;
    }


     /**
     * @Route("/admin", name="admin_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
       $salles = $this->sallesrepository->findAll();
       $manager = $this->managerrepository->findAll();
       return $this->render ("backoff/index.html.twig", compact ('salles', 'manager'));
    }

    /**
     * @Route("/admin/{id}", name="admin_edit", methods="GET|POST")
     * @param Salles $salles
     */
    public function edit(Salles $salles, Request $request)
    {
        $form = $this->createForm(SallesType::class, $salles);
                      
        return $this->render('backoff/edit.html.twig', [
        'salle' => $salles,
        'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/{id}", name="admin_delete", methods="delete")
     *  @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Salles $salles, Manager $manager, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$salles->getId(), $request->get('_token'))) {
            $this->em->remove($salles);
            $this->em->flush();
            $this->addFlash('success', 'Le lieu ou l\'\utilisateur a bien été supprimé');
        }
        
        return $this->redirectToRoute('/backoff/index.html.twig');
    }
}