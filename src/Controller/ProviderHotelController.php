<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Entity\ProviderHotel;
use App\Form\ProviderHotelType;
use App\Repository\ProviderHotelImgRepository;
use App\Repository\ProviderHotelPrixRepository;
use App\Repository\ProviderHotelRepository;
use App\Repository\ProviderRepository;
use Proxies\__CG__\App\Entity\ProviderHotel as EntityProviderHotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/provider/hotel")
 */
class ProviderHotelController extends AbstractController
{
    /**
     * @Route("/", name="provider_hotel_index", methods={"GET"})
     */
    public function index(ProviderHotelRepository $providerHotelRepository): Response
    {
        if ($this->getUser()){
            return $this->render('provider_hotel/index.html.twig', [
                'provider_hotels' => $providerHotelRepository->findAll(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/new", name="provider_hotel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $providerHotel = new ProviderHotel();
        $form = $this->createForm(ProviderHotelType::class, $providerHotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($providerHotel);
            $entityManager->flush();

            return $this->redirectToRoute('provider_hotel_index');
        }
        if ($this->getUser()){
            return $this->render('provider_hotel/new.html.twig', [
                'provider_hotel' => $providerHotel,
                'form' => $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/show/img/{id}", name="provider_img_show", methods={"GET"})
     */
    public function show(ProviderHotelImgRepository $providerhotelimgRepository,ProviderHotel $id): Response
    {
        if ($this->getUser()){
            return $this->render('provider_hotel_img/index.html.twig', [
                'provider_hotel_imgs' => $providerhotelimgRepository->findByProviderhotels($id),
                
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }
    /**
     * @Route("/show/{id}", name="provider_hotel_show", methods={"GET"})
     */
    public function show1(ProviderHotel $providerHotel): Response
    {   
        if ($this->getUser()){
            return $this->render('provider_hotel/show.html.twig', [
                'provider_hotel' => $providerHotel,
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
            
    }

    /**
     * @Route("/show/prix/{id}", name="provider_prix_show", methods={"GET"})
     */
    public function show2(ProviderHotelPrixRepository $providerhotelprixRepository,ProviderHotel $id, ProviderHotel $providerHotel): Response
    {
        if ($this->getUser()){
            return $this->render('provider_hotel_prix/index.html.twig', [
                'provider_hotel_prixes' => $providerhotelprixRepository->findByProviderhotels($id),
                'provider_hotel' => $providerHotel
                
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }



    /**
     * @Route("/{id}/edit", name="provider_hotel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProviderHotel $providerHotel): Response
    {
        $form = $this->createForm(ProviderHotelType::class, $providerHotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('provider_hotel_index');
        }
        if ($this->getUser()){
            return $this->render('provider_hotel/edit.html.twig', [
                'provider_hotel' => $providerHotel,
                'form' => $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }
    /**
     * @Route("/{id}", name="provider_hotel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProviderHotel $providerHotel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$providerHotel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($providerHotel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('provider_hotel_index');
    }

}
