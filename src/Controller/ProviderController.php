<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Entity\ProviderProviderHotel;
use App\Form\ProviderType;
use App\Repository\ProviderHotelRepository;
use App\Repository\ProviderProviderHotelRepository;
use Proxies\__CG__\App\Entity\ProviderHotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/provider")
 */
class ProviderController extends AbstractController
{
    /**
     * @Route("/", name="provider_index", methods={"GET"})
     */
    public function index(): Response
    {   if ($this->getUser()){
            $providers = $this->getDoctrine()
                ->getRepository(Provider::class)
                ->findAll();

            return $this->render('provider/index.html.twig', [
                'providers' => $providers,
                
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/new", name="provider_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($provider);
            $entityManager->flush();

            return $this->redirectToRoute('provider_index');
        }
        if ($this->getUser()){
            return $this->render('provider/new.html.twig', [
                'provider' => $provider,
                'form' => $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }
    /**
     * @Route("/show/{id}", name="provider_show", methods={"GET"})
     */
    public function show(Provider $provider): Response
    {   if ($this->getUser()){
            return $this->render('provider/show.html.twig', [
                'provider' => $provider,
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
    }
    /**
     * @Route("/{id}/edit", name="provider_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Provider $provider): Response
    {
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('provider_index');
        }
        if ($this->getUser()){
            return $this->render('provider/edit.html.twig', [
                'provider' => $provider,
                'form' => $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('app_login');
        }
        
    }
    /**
     * @Route("/hotels/{id}", name="hotelsprovider")
     */
    public function hotelsprovider(Provider $id, ProviderHotelRepository $providerHotelRepository, Provider $provider)
    {
    return $this->render('provider_hotel/hotelsprov.html.twig',[
                            'provid'=> $providerHotelRepository->findByProvide($id),
                            'provider' => $provider]);
    }

    /**
     * @Route("/{id}", name="provider_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Provider $provider): Response
    {
        if ($this->isCsrfTokenValid('delete'.$provider->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($provider);
            $entityManager->flush();
        }

        return $this->redirectToRoute('provider_index');
    }

}
