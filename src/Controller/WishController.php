<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wish', name: 'wish_')]
final class WishController extends AbstractController
{
    #[Route('', name: 'list')]
    public function list(): Response
    {
        // TODO : Afficher la liste des souhaits
        return $this->render('wish/list.html.twig');
    }

    #[Route('/{id}', name: 'detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function detail(int $id): Response
    {
        // TODO : Afficher le détail d'un souhait
        return $this->render('wish/detail.html.twig');
    }
}
