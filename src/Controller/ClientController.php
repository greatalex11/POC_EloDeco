<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Projet;
use App\Entity\User;
use App\Form\ClientType;
use App\Form\UserType;
use App\Repository\ClientRepository;
use App\Repository\PartenaireRepository;
use App\Repository\ProjetRepository;
use App\Repository\UserRepository;
use ContainerK7Slwta\getProjetRepositoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_CLIENT")]
#[Route('/client')]
class ClientController extends AbstractController
{
    #[IsGranted("ROLE_ADMIN")]
    #[Route('/', name: 'app_client_index', methods: ['GET'])]
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client/new.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/projet/{projet_id}', name: 'app_client_show_projet', methods: ['GET'])]
    public function showProjet(int $projet_id, Request $request, Client $client, ProjetRepository $ProjetRepository, PartenaireRepository $partenaireRepository): Response
    {

        if ($projet_id) {
            $projet = $ProjetRepository->find($projet_id);
            $partenaires = $partenaireRepository->findByProjet($projet);
        }


        return $this->render('client/show.html.twig', [
            'client' => $client,
            'type' => 'projet',
            'projet' => $projet ?? null,
            'Partenaires' => $partenaires ?? [],
        ]);
    }

    #[Route('/{id}/documents', name: 'app_client_show_documents', methods: ['GET'])]
    public function showDocuments(Request $request, Client $client): Response
    {

        return $this->render('client/show.html.twig', [
            'client' => $client,
            'type' => 'document',
            'documents' => [],
        ]);
    }

    #[Route('/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {

        $this->checkIsTheSameClient($client);

        $form = $this->createForm(UserType::class, $client->getUser(), ['TYPE' => Client::class]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        $user = $this->getUser();
        $projet = $user?->getClient()?->getProjets();

        return $this->render('client/edit.html.twig', [
            'client' => $client,
            'form' => $form,
            'projet' => $projet,
        ]);
    }

    #[Route('/{id}', name: 'app_client_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        $this->checkIsTheSameClient($client);

        if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->request->get('_token'))) {
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
    }

    private function checkIsTheSameClient(Client $client): void
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($client !== $user->getClient()) {
            throw $this->createAccessDeniedException("Ce client ne vous appartient pas");
        }
    }

    #[Route('/show', name: 'app_Client_show', methods: ['GET'])]
    public function tbordClient(Client $client): Response
    {
        $this->checkIsTheSameClient($client);

        return $this->render('client/show.html.twig');

    }


    #[Route('/{id}/profile', name: 'app_client_monprofile', methods: ['GET'])]
    public function profileClient(Client $client, ClientRepository $clientRepository, UserRepository $userRepository): Response
    {
        /** @var Client $client */
        /** @var User $user */
        $this->checkIsTheSameClient($client);
        $user = $this->getuser();
        $projets = $user?->getClient()?->getProjets()->filter(function (Projet $projet) {
            return $projet->getClients()->count() >= 2;
        });
        return $this->render('client/clientprofile.html.twig', [
            'client' => $user?->getClient(),
            'projets' => $projets,
        ]);

    }

    /*
        #[Route('/tbordProjet', name: 'app_client_tbordProjet', methods: ['GET'])]
        private function tbordPjetClient(ClientRepository $clientRepository, $client): Response
        {
            $this->checkIsTheSameClient($client);
            return $this->render('client/tbordPjtClient.html.twig')


        }*/

    #[Route('/{id}', name: 'app_client_show', methods: ['GET'])]
    public function show(Request $request, Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            'client' => $client,
            'type' => '',
        ]);
    }

}
