<?php

namespace App\Controller;

use App\Entity\Ad;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdController extends AbstractController
{
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
     * @Route("/ads/producer/{producer}")
     */
    public function fetch_ads_with_specific_producers($producer)
    {
        $ad_repo = $this->getDoctrine()->getRepository(Ad::class);
        $ad_objects = $ad_repo->findBy(['car_producer'=>$producer]);
        foreach ($ad_objects as $ad) {
            $IDs[] = $ad->getId();
        }
        return new Response(json_encode($IDs));
    }

    /**
     * @Route("ads/new")
     */
    public function post_new_ad() 
    {
        $form = $this->createFormBuilder()
            ->add('Your_name', TextType::class)
            ->add('Your_city', TextType::class)
            ->add('Car_price', TextType::class)
            ->add('Car_producer', TextType::class)
            ->add('Car_model', TextType::class)
            ->add('Car_year', TextType::class)
            ->add('Post', SubmitType::class, ['label' => 'Post Ad'])
            ->getForm();

        return $this->render('ad/new_ad.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}