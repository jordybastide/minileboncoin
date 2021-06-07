<?php

namespace App\Controller;

use App\Entity\Ad;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ad")
 */
class PublicAdController extends AbstractController
{
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