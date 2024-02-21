<?php

namespace App\Controller;

use App\Entity\Driver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DriverController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/drivers', name: 'drivers_index', methods: ['GET'])]
    public function index()
    {
        $drivers = $this->entityManager->getRepository(Driver::class)->findAll();

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
        $driver = new Driver();

        $driver->setName($request->get('name'))
            ->setSurname($request->get('surname'))
            ->setLicense($request->get('license'));

        $this->entityManager->persist($driver);
        $this->entityManager->flush();

        return $this->redirectToRoute('drivers_index');
    }

    #[Route('/drivers/{id}/edit', name: 'drivers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id)
    {
        $driver = $this->entityManager->getRepository(Driver::class)->find($id);

        if (!$driver) {
            throw $this->createNotFoundException("No driver found for id $id");
        }

        if ($request->isMethod('post')) {
            $driver->setName($request->get('name'))
                ->setSurname($request->get('surname'))
                ->setLicense($request->get('license'));

            $this->entityManager->flush();
        }

        return $this->render('drivers/edit.html.twig', compact('driver'));
    }

    #[Route('/drivers/{id}/delete', name: 'drivers_delete', methods: ['DELETE'])]
    public function delete(int $id)
    {
        $driver = $this->entityManager->getRepository(Driver::class)->find($id);

        if (!$driver) {
            throw $this->createNotFoundException("No driver found for id $id");
        }

        $this->entityManager->remove($driver);
        $this->entityManager->flush();

        return $this->redirectToRoute('drivers_index');
    }
}
