<?php

namespace App\Controller;

use App\Entity\Ad;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        // displays Ads
        $data = $this->getDoctrine()
            ->getRepository(Ad::class)
            ->findBy([],['createdAt' => 'desc']); //order them by date
        if (!$data) {
        }

        //paginate Ads
        $ads = $paginator->paginate(
             $data, // Request with the data we want to paginate (our Ads)
             $request->query->getInt('page', 1), // Current page, see in URL, 1 if no page
             10 // Results per page
        );
        return $this->render('index/index.html.twig', [
            'ads' => $ads,
        ]);
    }
}
