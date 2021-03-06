<?php

namespace App\Controller;

use App\Entity\ProviderHotelPrix;
use App\Form\ProviderHotelPrixType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/provider/hotel/prix")
 */
class ProviderHotelPrixController extends AbstractController
{
    /**
     * @Route("/", name="provider_hotel_prix_index", methods={"GET"})
     */
    public function index(): Response
    {
        $providerHotelPrixes = $this->getDoctrine()
            ->getRepository(ProviderHotelPrix::class)
            ->findAll();

        if ($this->getUser()){
            return $this->render('provider_hotel_prix/index.html.twig', [
                'provider_hotel_prixes' => $providerHotelPrixes,
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/new", name="provider_hotel_prix_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $providerHotelPrix = new ProviderHotelPrix();
        $form = $this->createForm(ProviderHotelPrixType::class, $providerHotelPrix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($providerHotelPrix);
            $entityManager->flush();

            return $this->redirectToRoute('provider_hotel_prix_index');
        }
        if ($this->getUser()){
            return $this->render('provider_hotel_prix/new.html.twig', [
                'provider_hotel_prix' => $providerHotelPrix,
                'form' => $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/{id}", name="provider_hotel_prix_show", methods={"GET"})
     */
    public function show(ProviderHotelPrix $providerHotelPrix): Response
    {
        if ($this->getUser()){
            return $this->render('provider_hotel_prix/show.html.twig', [
                'provider_hotel_prix' => $providerHotelPrix,
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/{id}/edit", name="provider_hotel_prix_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProviderHotelPrix $providerHotelPrix): Response
    {
        $form = $this->createForm(ProviderHotelPrixType::class, $providerHotelPrix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('provider_hotel_prix_index');
        }
        if ($this->getUser()){
            return $this->render('provider_hotel_prix/edit.html.twig', [
                'provider_hotel_prix' => $providerHotelPrix,
                'form' => $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
        
    }

}
