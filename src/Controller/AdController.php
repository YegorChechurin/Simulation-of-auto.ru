<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function show_home_page() 
    {
        $ad_repo = $this->getDoctrine()->getRepository(Ad::class);
        $producers = $ad_repo->findAllProducers();
        $countries = $ad_repo->findAllCountries();
        $years = $ad_repo->findYearRange();
        return $this->render('ad/home_page.html.twig',
            [
                'producers'=>$producers,
                'countries'=>$countries,
                'years'=>$years
            ]
         );
    }

	/**
	 * @Route("/ads", name="all_ads")
	 */
    public function show_all_ads() 
    {
        $ad_repo = $this->getDoctrine()->getRepository(Ad::class);
        $all_ads = $ad_repo->findAll();
        return $this->render('ad/ads_all.html.twig',['ads'=>$all_ads]);
    }

    /**
	 * @Route("/ads/{ad_id}", name="specific_ad", requirements={"ad_id"="\d+"})
	 */
    public function show_spefic_ad($ad_id)
    {
    	$ad_repo = $this->getDoctrine()->getRepository(Ad::class);
        $ad = $ad_repo->find($ad_id);
        $car = $ad->getCar();
        return $this->render('ad/ad_specific.html.twig',['ad'=>$ad,'car'=>$car]);
    }
    
    /**
     * @Route("/ads/ajax{query_string}", name="ajax_service", requirements={"query_string"="(\?.*)?"})
     */
    public function fetch_specific_ads()
    {
        $producer = $_GET['producer'];
        $country = $_GET['country'];
        $year = $_GET['year'];
        $ad_repo = $this->getDoctrine()->getRepository(Ad::class);
        $ads = $ad_repo->findSpecificAds($country,$producer,$year);
        $response = new Response();
        $response->setContent(json_encode($ads));
        $response->headers->set('Content-Type', 'application/json');
        return new Response(json_encode($ads));
    }

    /**
     * @Route("ads/new")
     */
    public function post_new_ad(Request $request) 
    {
        $form = $this->createForm(AdType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ad = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ad);
            $entityManager->flush();
            return $this->redirectToRoute('submission_success');
        }

        return $this->render('ad/new_ad.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("ads/new/success",name="submission_success")
     */
    public function new_ad_success()
    {
        return new Response('Congrats, your ad has been posted');
    }

}