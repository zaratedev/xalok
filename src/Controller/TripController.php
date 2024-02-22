<?php

namespace App\Controller;

use App\Entity\Trip;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TripController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/trip', name: 'trip_index')]
    public function index(): Response
    {
        $trips = $this->entityManager->getRepository(Trip::class)->findAll();

        return $this->render('trip/index.html.twig', compact('trips'));
    }

    #[Route('/trip/create', name: 'trip_create', methods: ['GET', 'POST'])]
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $trip = new Trip();

            $this->entityManager->persist($driver);
            $this->entityManager->flush();

            return $this->redirectToRoute('trip_index');
        }

        return $this->render('trip/create.html.twig');
    }
}
