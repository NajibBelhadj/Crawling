<?php

namespace App\Controller;

use App\Entity\Ville;
use Proxies\__CG__\App\Entity\ProviderHotel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class CrawlingController extends AbstractController
{
    /**
     * @Route("/admin/crawling", name="crawling")
     */
    public function index(HttpFoundationRequest $request)
    {
        if(stristr($request->requestUri, '?', true)){
            $id=$request->get('box');
            $from=$request->get('from');
            $to=$request->get('to');
            $month=substr($from,5,2);
            $day=substr($from,8,2);
            $year=substr($from,0,4);
            $from=$day.'/'.$month.'/'.$year;
            $month=substr($to,5,2);
            $day=substr($to,8,2);
            $year=substr($to,0,4);
            $to=$day.'/'.$month.'/'.$year;

            
            $link=$this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findOneById($id)->getLink();
            $provider=$this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findOneById($id)->getProvide()->getName();
            
            
            if($provider == "Tahavoyage"){
               exec("test.py $from $to $id $link");
            }
            elseif($provider == "Traveltodo"){
                exec("testt.py $from $to $id \"$link");
                dump($link);

                
            }
            ini_set('memory_limit', '-1');
            set_time_limit(50000);
            
            return $this->render('crawling/index.html.twig', [
                'villes' => $this->getDoctrine()->getManager()->getRepository(Ville::class)->findAll(),
                'hotels' => $this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findAll(),
            ]);

        }
        else{ 
            return $this->render('crawling/index.html.twig', [
                'villes' => $this->getDoctrine()->getManager()->getRepository(Ville::class)->findAll(),
                'hotels' => $this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findAll(),
            ]);
        }
    }
}
