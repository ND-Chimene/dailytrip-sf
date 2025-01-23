<?php

namespace App\Controller;

use App\Form\TripType;
use App\Repository\TripRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TripController extends AbstractController
{
    #[Route('/trips', name: 'app_trips', methods: ['GET'])]
    public function index(TripRepository $tr, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $tr->findAll(),
            $request->query->getInt('page', 1), /* page number */
            18 /* limit per page */
        );


        return $this->render('trip/index.html.twig', [
            'trips' => $pagination,
            'title' => "Trips",
            'descrition' => "Les trips disponibles sur la platforme",
        ]);
    }

    #[Route('/trip/{ref}', name: 'app_trip', methods: ['GET'])]
    public function show(TripRepository $tr, string $ref): Response
    {
        $trip = $tr->findOneBy(['ref' => $ref]);
        return $this->render('trip/show.html.twig', [
            'trip' => $trip,
            'title' => $trip->getTitle(),
            'descrition' => $trip->getDescription(),
        ]);
    }

    /**
     * Route permettant l'accès à la modification d'un Trip
     */
    #[Route('/trip/{ref}/edit', name: 'app_trip_edit', methods: ['GET', 'POST'])]
    public function edit(TripRepository $tr, string $ref): Response
    {
        $trip = $tr->findOneBy(['ref' => $ref]); // Récupérer 1 trip
        $form = $this->createForm(TripType::class, $trip);
        return $this->render('page/edit.html.twig', [
            'trip' => $trip,
            'tripForm' => $form,
        ]);
    }
}
