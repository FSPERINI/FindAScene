<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $places = $this->repository->findAll();
        return $this>render('admin/index.html.twig', compact('places'));
    }
}