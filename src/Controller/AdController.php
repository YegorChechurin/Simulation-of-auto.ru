<?php

namespace App\Controller;

use App\Entity\Ad;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdController extends AbstractController
{
	/**
	 * @Route("/ads", name="all_ads")
	 */
    public function show_all_ads() 
    {
        $ad_repo = $this->getDoctrine()->getRepository(Ad::class);
        $all_ads = $ad_repo->findAll();
        //return new Response($all_ads[0]->getCar()->getProducerCountry());
        return $this->render('ad/ads_all.html.twig',['ads'=>$all_ads]);
    }

    /**
	 * @Route("/ads/{ad_id}", name="specific_ad", requirements={"ad_id"="\d+"})
	 */
    public function show_spefic_ad($ad_id)
    {
    	//
    }
    
    /**
     * @Route("/ad", name="ad")
     */
    public function index()
    {
        return $this->render('ad/index.html.twig', [
            'controller_name' => 'AdController',
        ]);
    }
}