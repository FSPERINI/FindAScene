<?php
//Espace Administrateur du site


namespace App\Controller;

use App\Entity\Salles;
use App\Form\SallesType;
use App\Repository\SallesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends AbstractController
{
    /**
     * @var SallesRepository
     */
    private $repository;

    public function __construct(SallesRepository $repository)
    {
        $this->repository = $repository;
    }
    

    /**
     * @Route("/admin", name="admin.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
       $salles = $this->repository->findAll();
       return $this->render ("backoff/index.html.twig", compact ('salles'));
    }

    /**
     * @Route("/admin/{id}, name="admin.edit")
     * @param Salles $salles
     */
    public function edit(Salles $salles)
    {
        $form = $this->createForm(SallesType::class, $salles);
        return $this->render('backoff/edit.html.twig', [
        'salle' => $salles,
        'form' => $form->createView()
        ]);
    }
}