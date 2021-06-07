<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\User;
use App\Form\AdType;
use App\Form\UserType;
use App\Repository\AdRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class AdminController extends AbstractController
{
     /**
     * @Route("/", name="admin_index", methods={"GET"})
     */
     public function index(): Response
     {
          return $this->render('admin/admin.html.twig');
     }

     /**
      * @Route("/ad", name="admin_ad_index", methods={"GET"})
      */
     public function indexAd(AdRepository $adRepository): Response
     {
          return $this->render('admin/ad/index.html.twig', [
               'ads' => $adRepository->findAll(),
          ]);
     }

     /**
     * @Route("/ad/{id}", name="admin_ad_show", methods={"GET"})
     */
     public function showAd(Ad $ad): Response
     {
          return $this->render('admin/ad/show.html.twig', [
               'ad' => $ad,
          ]);
     }

     /**
     * @Route("/ad/{id}/edit", name="admin_ad_edit", methods={"GET","POST"})
     */
     public function editAd(Request $request, Ad $ad): Response
     {
          $form = $this->createForm(AdType::class, $ad);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
               $this->getDoctrine()->getManager()->flush();

               return $this->redirectToRoute('admin_ad');
          }

          return $this->render('admin/ad/edit.html.twig', [
               'ad' => $ad,
               'form' => $form->createView(),
          ]);
     }

     /**
     * @Route("/ad/{id}", name="admin_ad_delete", methods={"POST"})
     */
     public function deleteAd(Request $request, Ad $ad): Response
     {
          if ($this->isCsrfTokenValid('delete'.$ad->getId(), $request->request->get('_token'))) {
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->remove($ad);
               $entityManager->flush();
          }

          return $this->redirectToRoute('admin_ad');
     }

     /**
     * @Route("/user", name="admin_user_index", methods={"GET"})
     */
     public function indexUser(UserRepository $userRepository): Response
     {
          return $this->render('admin/user/index.html.twig', [
               'users' => $userRepository->findAll(),
          ]);
     }

     /**
     * @Route("/user/{id}", name="admin_user_show", methods={"GET"})
     */
     public function show(User $user): Response
     {
          return $this->render('admin/user/show.html.twig', [
               'user' => $user,
          ]);
     }

     /**
     * @Route("/user/{id}/edit", name="admin_user_edit", methods={"GET","POST"})
     */
     public function edit(Request $request, User $user): Response
     {
          $form = $this->createForm(UserType::class, $user);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
               $this->getDoctrine()->getManager()->flush();

               return $this->redirectToRoute('admin_user_index');
          }

          return $this->render('admin/user/edit.html.twig', [
               'user' => $user,
               'form' => $form->createView(),
          ]);
     }

     /**
     * @Route("/user/{id}", name="admin_user_delete", methods={"POST"})
     */
     public function delete(Request $request, User $user): Response
     {
          if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
               $entityManager = $this->getDoctrine()->getManager();
               $this->container->get('security.token_storage')->setToken(null);
               $entityManager->remove($user);
               $entityManager->flush();
          }
          $this->addFlash('success', 'Cet utilisateur a bien été supprimé !'); 

          return $this->redirectToRoute('admin_user_index');
     }
}