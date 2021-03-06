<?php

namespace App\Controller;

use App\Entity\ProviderHotelImg;
use App\Form\ProviderHotelImgType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/provider/hotel/img")
 */
class ProviderHotelImgController extends AbstractController
{
    /**
     * @Route("/", name="provider_hotel_img_index", methods={"GET"})
     */
    public function index(): Response
    {
        $providerHotelImgs = $this->getDoctrine()
            ->getRepository(ProviderHotelImg::class)
            ->findAll();
        if ($this->getUser()){
            return $this->render('provider_hotel_img/index.html.twig', [
                'provider_hotel_imgs' => $providerHotelImgs,
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/new", name="provider_hotel_img_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $providerHotelImg = new ProviderHotelImg();
        $form = $this->createForm(ProviderHotelImgType::class, $providerHotelImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($providerHotelImg);
            $entityManager->flush();

            return $this->redirectToRoute('provider_hotel_img_index');
        }
        if ($this->getUser()){
            return $this->render('provider_hotel_img/new.html.twig', [
                'provider_hotel_img' => $providerHotelImg,
                'form' => $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/{id}", name="provider_hotel_img_show", methods={"GET"})
     */
    public function show(ProviderHotelImg $providerHotelImg): Response
    {   
        if ($this->getUser()){
            return $this->render('provider_hotel_img/show.html.twig', [
                'provider_hotel_img' => $providerHotelImg,
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/{id}/edit", name="provider_hotel_img_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProviderHotelImg $providerHotelImg): Response
    {
        $form = $this->createForm(ProviderHotelImgType::class, $providerHotelImg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('provider_hotel_img_index');
        }
        if ($this->getUser()){
            return $this->render('provider_hotel_img/edit.html.twig', [
                'provider_hotel_img' => $providerHotelImg,
                'form' => $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }
    /**
     * @Route("/{id}", name="provider_hotel_img_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProviderHotelImg $providerHotelImg): Response
    {
        if ($this->isCsrfTokenValid('delete'.$providerHotelImg->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($providerHotelImg);
            $entityManager->flush();
        }

        return $this->redirectToRoute('provider_hotel_img_index');
    }

}
