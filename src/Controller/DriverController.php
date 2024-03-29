<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Service\DriverService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DriverController extends AbstractController
{
    private $driverService;

    public function __construct(DriverService $driverService)
    {
        $this->driverService = $driverService;
    }

    #[Route('/drivers', name: 'drivers_index', methods: ['GET'])]
    public function index()
    {
        $drivers = $this->driverService->getAllDrivers();

        return $this->render('drivers/index.html.twig', compact('drivers'));
    }

    #[Route('/drivers/create', name: 'drivers_create', methods: ['GET'])]
    public function create()
    {
        return $this->render('drivers/create.html.twig');
    }

    #[Route('/drivers/store', name: 'drivers_store', methods: ['POST'])]
    public function store(Request $request)
    {
        $this->driverService->createDriver($request->request->all());

        return $this->redirectToRoute('drivers_index');
    }

    #[Route('/drivers/{id}/edit', name: 'drivers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id)
    {
        $driver = $this->driverService->getDriverById($id);

        if (!$driver) {
            throw $this->createNotFoundException("No driver found for id $id");
        }

        if ($request->isMethod('post')) {
            $this->driverService->updateDriver($driver, $request->request->all());
        }

        return $this->render('drivers/edit.html.twig', compact('driver'));
    }

    #[Route('/drivers/{id}/delete', name: 'drivers_delete', methods: ['DELETE'])]
    public function delete(int $id)
    {
        $driver = $this->driverService->getDriverById($id);

        if (!$driver) {
            throw $this->createNotFoundException("No driver found for id $id");
        }

        $this->driverService->deleteDriver($driver);

        return $this->redirectToRoute('drivers_index');
    }
}
