<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/ad")
 */
class PublicAdController extends AbstractController
{

     /**
      * @Route("/search-result", name="ad_search", methods={"GET"})
      */
     public function search()
     {
          return $this->render('public/ad/search.html.twig');
     }

     /**
      * @Route("/search-json", name="search_json", methods={"GET"})
      */
     public function searchJson(Request $request, AdRepository $adRepository)
     {
          $terms = $request->get('terms');
          $ads = $adRepository->findByTerms($terms);

          return new JsonResponse($ads);
     }

     /**
      * @Route("/{id}", name="public_ad_show", methods={"GET"})
      */
     public function show(Ad $ad): Response
     {
          return $this->render('public/ad/show.html.twig', [
               'ad' => $ad,
          ]);
     }

}