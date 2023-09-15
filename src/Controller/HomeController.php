<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Repository\TrickRepository;

class HomeController extends AbstractController
{
    private $trickRepository;

    public function __construct(TrickRepository $trickRepository)
    {
        $this->trickRepository = $trickRepository;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $title = "Accueil";
        $tricks = $this->trickRepository->findAll();
        // dd($tricks);

        return $this->render('home/index.html.twig', [
            'title' => $title,
            'tricks' => $tricks
        ]);
    }
}
