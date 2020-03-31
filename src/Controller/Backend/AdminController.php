<?php
//Espace Administrateur du site


namespace App\Controller\Admin;

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
       return $this->render ("backend/index.html.twig", compact ('salles'));
    }
}