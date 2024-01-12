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

    // Get the details of one trick
    #[Route('/trick/{id}', name: 'trick_show')]
    public function index(TrickRepository $trickRepository, int $id): Response
    {
        $trick = $trickRepository->find($id);
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController',
            'trick'=> $trick,
        ]);
    }

    // Get the form to create a new trick
    #[Route('/trick/create', name: 'trick_create')]
    public function create(Request $request)
    {
        // Create a new class Trick
        $trick = new Trick();
        // Get the form to create the new trick
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        // Verify if the form was submitted and all inputs fields valid
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // Insert the created date
            $trick->setCreatedAt(new DateTime());

            // Register the new trick
            $em->persist($trick);
            $em->flush();

            // Return to the view with a message success
            $this->addFlash('success', 'Figure correctement enregistrée !');
            return $this->redirectToRoute('app_home');
        }

        // Return the view of the trick form
        return $this->render('trick/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/trick/{slug}/edit', name: 'trick_edit')]
    public function edit(TrickRepository $trickRepository, $slug): Response
    {
        $trick = $trickRepository->findOneBySlug($slug);
        return $this->render('trick/edit.html.twig', [
            'trick' => $trick
        ]);
    }

    #[Route('/trick/update', name: 'trick_update')]
    public function update($slug, Request $request)
    {
        dd($request);
    }
}
