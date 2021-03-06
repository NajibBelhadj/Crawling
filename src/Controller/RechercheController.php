<?php

namespace App\Controller;

use App\Entity\ProviderHotel;
use App\Entity\ProviderHotelPrix;
use App\Entity\Ville;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    /**
     * @Route("/admin/recherche", name="recherche")
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function getPrices(Request $request):Response
    {   
        if(stristr($request->requestUri, '?', true)){

           $id=$request->get('select');
           $from=$request->get('datepickerfrom');
           $month=substr($from,0,2);
           $day=substr($from,3,2);
           $year=substr($from,6,4);
           $from=$day.'/'.$month.'/'.$year;
           dump($id);

           $idVille=$request->get('ville');

           $to=$request->get('datepickerto');
           $month=substr($to,0,2);
           $day=substr($to,3,2);
           $year=substr($to,6,4);
           $to=$day.'/'.$month.'/'.$year;
           $int=0;
           $maxprix=0;
           $minprix=0;
           $chart=[];
           
            $moyennePrixHotel=[];
            $maxprixTab=[];
            $minprixTab=[];
            if($id == "1"){
               $hotels=$this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findPV($idVille);
           
               foreach($hotels as $hotelRef){
                   $allPrix=[];
                    $series=[];
                    $id=$hotelRef->getId();
                    $ho=$hotelRef->getName();
                    $hotel=$this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findByRefe((int)$id);
                    $date=[];
                    $ob = new Highchart();
                    $ob->chart->renderTo('a'.strval($int));
                    $ob->title->text($ho);

                    $SommePrix=0;
                    $moyennePrix=0;
                    $count = 0;
                    for($i=0;$i<count($hotel);$i++){     
                            $prix=[];
                            $p=$hotel[$i]->getId();
                            if($p != $id){ 
                                $test=$this->getDoctrine()->getManager()->getRepository(ProviderHotelPrix::class)->findByproviderhotels($p);
                                
                                foreach($test as $te){
                                    
                                    if(strtotime(str_replace('/', '-', $te->getDate())) >=strtotime(str_replace('/', '-', $from)) && strtotime(str_replace('/', '-', $te->getDate())) <=strtotime(str_replace('/', '-', $to))){
                                        if(in_array($te->getDate(), $date)){
                                        }
                                        else{
                                            array_push($date, $te->getDate());
                                        }
                                        //dump($date);
                                        array_push($prix, intval($te->getPrix()));
                                        array_push($allPrix, intval($te->getPrix()));
                                        
                                        $SommePrix = $SommePrix + intval($te->getPrix());
                                        $count=$count+1;
                                    }
                                }
                                
                                array_push($series, array("name" => $hotel[$i]->getProvide()->getName(),"data" => $prix));
                                $ob->xAxis->title(array('text' => "Date"));
                                $ob->xAxis->categories($date);
                                $ob->series($series);
                                $ob->yAxis->title(array('text'=>'Prix (TND)'));
                            }
                        }
                        $int=$int+1;
                        array_push($chart,$ob);
                        
                        $moyennePrix=round($SommePrix / $count,3);
                        array_push($moyennePrixHotel,$moyennePrix); 
                        

                        $maxprix=$allPrix[0];
                        for($h=0 ;$h<count($allPrix);$h++){
                            if($allPrix[$h]>$maxprix){
                                $maxprix=$allPrix[$h];
                            }
                        }
                        array_push($maxprixTab,$maxprix);
                        
                        $minprix=$allPrix[0];
                        for($h=0 ;$h<count($allPrix);$h++){
                            if($allPrix[$h]<$minprix){
                                $minprix=$allPrix[$h];
                            }
                        }
                        array_push($minprixTab,$minprix);    
                }
                $moyennePrixVille=0;
                for($h=0 ;$h<count($moyennePrixHotel);$h++){
                    $moyennePrixVille=$moyennePrixVille + $moyennePrixHotel[$h];
                }

                $maxPrixVille=$maxprixTab[0];
                for($h=0 ;$h<count($maxprixTab);$h++){
                    if($maxprixTab[$h]>$maxPrixVille)
                    $maxPrixVille=$maxprixTab[$h];
                }
                $minPrixVille=$minprixTab[0];
                for($h=0 ;$h<count($minprixTab);$h++){
                    if($minprixTab[$h]<$minPrixVille)
                    $minPrixVille=$minprixTab[$h];
                }
                        
                    dump($minPrixVille);
                  
            return $this->render('recherche/index2.html.twig', [
                'ville' =>$this->getDoctrine()->getManager()->getRepository(Ville::class)->findOneById($idVille)->getVille(),
                'moyenneprix' => round($moyennePrixVille/count($moyennePrixHotel),3),
                'maxprix' => $maxPrixVille,
                'minprix' => $minPrixVille,
                'provider_hotel_ref' => $this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findByProvide(1),
                'villes' => $this->getDoctrine()->getManager()->getRepository(Ville::class)->findAll(),
                'charts' => $chart,
                'chart' => $ob,
                'moynhot' => $moyennePrixHotel,
                'maxprixhot' => $maxprixTab,
                'minprixhot' => $minprixTab,
            ]);

            }

            elseif($id!=1){
                $series=[];
                $ho=$this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->find((int)$id)->getName();
                $hotel=$this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findByRefe((int)$id);
                $date=[];
                $ob = new Highchart();
                $ob->chart->renderTo('linechart');
                $ob->title->text($ho);

                $SommePrix=0;
                $moyennePrix=0;
                $count = 0;
                for($i=0;$i<count($hotel);$i++){     
                        $prix=[];
                        $p=$hotel[$i]->getId();
                        if($p != $id){ 
                            $test=$this->getDoctrine()->getManager()->getRepository(ProviderHotelPrix::class)->findByproviderhotels($p);
                            
                            foreach($test as $te){
                                
                                if(strtotime(str_replace('/', '-', $te->getDate())) >=strtotime(str_replace('/', '-', $from)) && strtotime(str_replace('/', '-', $te->getDate())) <=strtotime(str_replace('/', '-', $to))){
                                    if(in_array($te->getDate(), $date)){
                                    }
                                    else{
                                        array_push($date, $te->getDate());
                                    }
                                    //dump($date);
                                    array_push($prix, intval($te->getPrix()));
                                    $SommePrix = $SommePrix + intval($te->getPrix());
                                    $count=$count+1;
                                }
                            }
                            
                            array_push($series, array("name" => $hotel[$i]->getProvide()->getName(),"data" => $prix));
                            $ob->xAxis->title(array('text' => "Date"));
                            $ob->xAxis->categories($date);
                            $ob->series($series);
                            $ob->yAxis->title(array('text'=>'Prix (TND)'));
                        }
                    }
                    if($count!=0){
                        $moyennePrix=round($SommePrix / $count,3);
                    }
                    
                return $this->render('recherche/index1.html.twig', [
                    'provider_hotel_ref' => $this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findByProvide(1),
                    'chart' => $ob,
                    'villes' => $this->getDoctrine()->getManager()->getRepository(Ville::class)->findAll(),
                    'moyenneprix' => $moyennePrix
                ]);

            }
        }
    else{
        return $this->render('recherche/index.html.twig', [
            'provider_hotel_ref' => $this->getDoctrine()->getManager()->getRepository(ProviderHotel::class)->findByProvide(1),
            'villes' => $this->getDoctrine()->getManager()->getRepository(Ville::class)->findAll(),
        ]);
    }
    
    }   
}
