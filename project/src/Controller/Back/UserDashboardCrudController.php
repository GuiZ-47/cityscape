<?php

namespace App\Controller\Back;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/user')]
class UserDashboardCrudController extends AbstractController
{

    #[Route('/', name: 'app_back_user_dashboard_crud_show', methods: ['GET'])]
    public function show(UserRepository $userRepository): Response
    {   
        $user = $userRepository->find($this->getUser());

        // this->getUser() fonctionne aussi mais je n'aurais pas les relations de l'entité de chargé, c'est plus propre de passer par le repository
        // dd($this->getUser());

        // Sous Twig je peux écrire {{ app.user }} pour avoir accès aux mêmes infos

        return $this->render('back/user_dashboard_crud/show.html.twig', [
            'user'=> $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_user_dashboard_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_back_user_dashboard_crud_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/user_dashboard_crud/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_user_dashboard_crud_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_user_dashboard_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
