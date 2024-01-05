<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TrickRepository;

class TrickController extends AbstractController
{
    public $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    #[Route('/trick/{id}', name: 'trick_show')]
    public function index(TrickRepository $trickRepository, int $id): Response
    {
        $trick = $trickRepository->find($id);
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController',
            'trick'=> $trick,
        ]);
    }
}
