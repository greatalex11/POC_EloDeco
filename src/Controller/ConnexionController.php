<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Partenaire;
use App\Form\ConnectionType;
use App\Form\ConnectPartnerType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnexionController extends AbstractController
{
    #[Route('/connexion', name: 'app_connexion')]
    public function new(Request $request, EntityManagerInterface $entityManager, ClientRepository $clientRepository): Response
    {

        $client = new Client();
        $partenaire = new Partenaire();

        $form = $this->createForm(ConnectionType::class, $client);
        $formPartner = $this->createForm(ConnectPartnerType::class, $partenaire);
        $form->handleRequest($request);
        $formPartner->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientInBdd = $clientRepository->findOneBy(['Mail' => $client->getMail(), "MotDePass" => $client->getMotDePass()]);

            return $this->redirectToRoute('app_client_index/show', [], Response::HTTP_SEE_OTHER);
        }
        if ($formPartner->isSubmitted() && $formPartner->isValid()) {
            $entityManager->persist($partenaire);
            $entityManager->flush();
            return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('connexion/index.html.twig', [
            'formConexionClient' => $form,
            'formConexionPartner' => $formPartner,
        ]);
    }
}
