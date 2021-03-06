<?php

namespace App\Controller;

use App\Entity\ProviderHotel as EntityProviderHotel;
use App\Repository\ProviderHotelPrixRepository;
use App\Repository\ProviderHotelRepository;
use App\Repository\ProviderRepository;
use Proxies\__CG__\App\Entity\ProviderHotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * @Route("/api", name="api_")
 */
class APIController extends AbstractController
{
    /**
     * @Route("/provider", name="provider", methods={"GET"})
     */
    public function Provider(ProviderRepository $provider)
    {
        $hotel = $provider->apiFindAll();

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize(['status' =>'success','data'=>$hotel], 'json', [
            
            'data' => function($object){
                return $object->getId();
            }

        ]);

        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return  $response;

    }
        /**
     * @Route("/prix/{id}", name="prix", methods={"GET"})
     */
    public function Prix(ProviderHotelPrixRepository $providerhotelPrix,$id)
    {
        $hotel = $providerhotelPrix->apiFindAll($id);
        $provider=$this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findOneById($id)->getProvide()->getName();
        $name=$this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findOneById($id)->getName();
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize(['status' =>'success','Provider'=>$provider,'name'=>$name,'data'=>$hotel], 'json', [
            
            'data' => function($object){
                return $object->getId();
            }

        ]);

        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json');
        return  $response;

    }

}
