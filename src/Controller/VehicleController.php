<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Service\VehicleService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    private $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    #[Route('/vehicles', name: 'vehicles_index', methods: ['GET'])]
    public function index()
    {
        $vehicles = $this->vehicleService->getAllVehicles();

        return $this->render('vehicles/index.html.twig', compact('vehicles'));
    }

    #[Route('/vehicles/create', name: 'vehicles_create', methods: ['GET'])]
    public function create()
    {
        return $this->render('vehicles/create.html.twig');
    }

    #[Route('/vehicles/store', name: 'vehicles_store', methods: ['POST'])]
    public function store(Request $request)
    {
        $this->vehicleService->createVehicle($request->request->all());

        return $this->redirectToRoute('vehicles_index');
    }

    #[Route('/vehicles/{id}/edit', name: 'vehicles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id)
    {
        $vehicle = $this->vehicleService->getVehicleById($id);

        if (!$vehicle) {
            throw $this->createNotFoundException("No vehicle found for id $id");
        }

        if ($request->isMethod('POST')) {
            $this->vehicleService->updateVehicle($vehicle, $request->request->all());
        }

        return $this->render('vehicles/edit.html.twig', compact('vehicle'));
    }

    #[Route('/vehicles/{id}/delete', name: 'vehicles_delete', methods: ['DELETE'])]
    public function delete(int $id)
    {
        $vehicle = $this->vehicleService->getVehicleById($id);

        if (!$vehicle) {
            throw $this->createNotFoundException("No vehicle found for id $id");
        }

        $this->vehicleService->deleteVehicle($vehicle);

        return $this->redirectToRoute('vehicles_index');
    }
}
