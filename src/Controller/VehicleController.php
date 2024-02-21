<?php

namespace App\Controller;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/vehicles', name: 'vehicles_index', methods: ['GET'])]
    public function index()
    {
        $vehicles = $this->entityManager->getRepository(Vehicle::class)->findAll();

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
        $vehicle = new Vehicle();

        $vehicle->setBrand($request->get('brand'))
            ->setModel($request->get('model'))
            ->setPlate($request->get('plate'))
            ->setLicenseRequired($request->get('license_required'));

        $this->entityManager->persist($vehicle);
        $this->entityManager->flush();

        return $this->redirectToRoute('vehicles_index');
    }

    #[Route('/vehicles/{id}/edit', name: 'vehicles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id)
    {
        $vehicle = $this->entityManager->getRepository(Vehicle::class)->find($id);

        if (!$vehicle) {
            throw $this->createNotFoundException(
                'No vehicle found for id '.$id
            );
        }

        if ($request->isMethod('post')) {
            $vehicle->setBrand($request->get('brand'))
                ->setModel($request->get('model'))
                ->setPlate($request->get('plate'))
                ->setLicenseRequired($request->get('license_required'));

            $this->entityManager->flush();
        }

        return $this->render('vehicles/edit.html.twig', compact('vehicle'));
    }

    #[Route('/vehicles/{id}/delete', name: 'vehicles_delete', methods: ['DELETE'])]
    public function delete(int $id)
    {
        $vehicle = $this->entityManager->getRepository(Vehicle::class)->find($id);

        if (!$vehicle) {
            throw $this->createNotFoundException(
                'No vehicle found for id '.$id
            );
        }

        $this->entityManager->remove($vehicle);
        $this->entityManager->flush();

        return $this->redirectToRoute('vehicles_index');
    }
}
