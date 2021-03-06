<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Entity\ProviderHotel;
use App\Entity\RefHotel;
use App\Form\MappingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class MappingController extends AbstractController
{
    /**
     * @Route("/admin/mapping", name="mapping", methods={"GET"})
     */
    public function index( HttpFoundationRequest $request)
    {
        if(stristr($request->requestUri, '?', true)){
            $em = $this->getDoctrine()->getManager();
            $u=$request->requestUri;
            $u=$u."&";
            $tab=array();
            while(strpos($u,"=")!=false){
                $x=substr($u,strpos($u,"=")+1,strpos($u,"&")-strpos($u,"=")-1);
                array_push($tab,$x);
                $u=str_replace("=".$x."&","",$u);
            }

            for($i=0;$i<count($tab);$i++){
                $ref=$em->getRepository(ProviderHotel::class)->findOneById($tab[$i]);
                $ref->setRefe($tab[0]);
                $em->persist($ref);
            }
            $em->flush();

            $id=$request->get('select');
            $hotel=[];
            $a=$em->getRepository(Provider::class)->findAll();
            foreach($a as $ht){
                array_push($hotel, $em->getRepository(ProviderHotel::class)->findByProvide($ht->getId()));
            }
            return $this->render('mapping/index.html.twig', [
                'provider' => $em->getRepository(Provider::class)->findAll(),
                'hotel' => $hotel,
            ]);
        }
        else{
            $hotel=[];
            $em = $this->getDoctrine()->getManager();
            $a=$this->getDoctrine()->getManager()->getRepository(Provider::class)->findAll();
            foreach($a as $ht){
                array_push($hotel, $em->getRepository(ProviderHotel::class)->findByProvide($ht->getId()));
            }
            return $this->render('mapping/index.html.twig', [
                'provider' => $this->getDoctrine()->getManager()->getRepository(Provider::class)->findAll(),
                'hotel' => $hotel,
            ]);

        }
    
    
    }

}
    

