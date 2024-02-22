<?php

namespace App\Controller;

use App\Entity\Trip;
use App\Entity\Vehicle;
use App\Entity\Driver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route('/trip/create', name: 'trip_create', methods: ['GET'])]
    public function create(Request $request)
    {
        return $this->render('trip/create.html.twig');
    }

    #[Route('/api/trip/vehicles', name: 'trip_vehicles', methods: ['GET'])]
    public function vehicles(Request $request)
    {
        $vehicles = $this->entityManager
            ->getRepository(Vehicle::class)
            ->findByDate($request->query->get('date'));

        return $this->json(['data' => $vehicles], 200, [], [
            'groups' => ['vehicle'],
        ]);
    }

    #[Route('/api/trip/drivers', name: 'trip_drivers', methods: ['POST'])]
    public function drivers(Request $request)
    {
        $content = $request->getContent();
        $data = json_decode($content, true);

        $drivers = $this->entityManager
            ->getRepository(Driver::class)
            ->findByDateAndLicense($data['date'], $data['license']);

        return $this->json(['data' => $drivers]);
    }

    #[Route('/api/trip/store', name: 'trip_store', methods: ['POST'])]
    public function store(Request $request)
    {
        $content = $request->getContent();
        $data = json_decode($content, true);

        $vehicle = $this->entityManager->getRepository(Vehicle::class)->find($data['vehicle_id']);
        $driver = $this->entityManager->getRepository(Driver::class)->find($data['driver_id']);

        $trip = new Trip();
        $trip->setDate(new \DateTime($data['date']))
            ->setVehicle($vehicle)
            ->setDriver($driver);

        $this->entityManager->persist($trip);
        $this->entityManager->flush();

        return $this->json(['message' => 'Trip has been created success']);
    }
}
