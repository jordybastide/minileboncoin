<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\User;
use App\Form\AdType;
use App\Repository\AdRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/my-ads")
 * @Security("is_granted('ROLE_USER')")
 */
class AdController extends AbstractController
{
    /**
     * @Route("/", name="ad_index", methods={"GET"})
     */
    public function index(AdRepository $adRepository): Response
    {
        $ads = $adRepository->findBy([
            'user' => $this->getUser(),
        ]);
        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * @Route("/new", name="ad_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ad = new Ad();
        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $thumbnail = $form->get('thumbnail')->getData();
            // generate file name for associated thumbnail
            $file = md5(uniqid()) . '.' . $thumbnail->guessExtension();
            // copy file (thumbnail) into header_image_upload
            $thumbnail->move(
                $this->getParameter('images_directory'),
                $file
            );
            $ad
                ->setThumbnail('/header_image_uploads/' . $file)
                ->setUser($this->getUser())
                ->setCreatedAt(new \DateTime());
            $entityManager->persist($ad);
            $entityManager->flush();

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('ad/new.html.twig', [
            'ad' => $ad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ad_show", methods={"GET"})
     */
    public function show(Ad $ad): Response
    {
        return $this->render('ad/show.html.twig', [
            'ad' => $ad,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ad_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ad $ad): Response
    {
        if (!$this->isGranted('AD_EDIT', $ad)) {
            
            return $this->redirectToRoute('ad_index');
        }
        $form = $this->createForm(AdType::class, $ad);
        $thumbnail = $ad->getThumbnail();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            if ($ad->getThumbnail() === null) {

                $ad
                ->setThumbnail($thumbnail);
            }
            $ad
                ->setUpdatedAt(new \DateTime());
                
            $entityManager->flush();

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('ad/edit.html.twig', [
            'ad' => $ad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ad_delete", methods={"POST"})
     */
    public function delete(Request $request, Ad $ad): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ad->getId(), $request->request->get('_token'))) {
            //on recupère le nom de l'image
            $name = $ad->getThumbnail();
            //on supprime le fichier
            unlink($this->getParameter('public_dir').'/'.$name);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ad);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ad_index');
    }
}
