<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
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

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdsController extends AbstractController
{
	/**
	 * @Route("/ads/all", name="all_ads")
	 */
    public function show_all_ads() 
    {
        return $this->render('ads/ads.html.twig');
    }

    /**
	 * @Route("/ads/{ad_id}", name="specific_ad", requirements={"ad_id"="\d+"})
	 */
    public function show_spefic_ad($ad_id)
    {
    	//
    }
}