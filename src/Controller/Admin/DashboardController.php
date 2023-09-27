<?php

namespace App\Controller\Admin;

use App\Controller\ProjetCrudController;
use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_ADMIN")]
class DashboardController extends AbstractDashboardController
{
    public function __construct(private UserRepository $userRepository)
    {

    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //

        $date = date('r');


        return $this->render('admin/index.html.twig', [
            'user' => $this->getUser(),
            'date' => $date,

        ]);
    }

    //private function projetsUser (getClientRepositoryService, getPartenaireRepositoryService){//

    public function configureDashboard(): Dashboard
    {
        /** @var User $user */

        return Dashboard::new()
            ->setTitle('EloDeco');


    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Client', 'fa fa-user', ClientCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Partenaire', 'fa fa-user', PartenaireCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Projet', 'fa fa-uikit', \App\Controller\Admin\ProjetCrudController::getEntityFqcn());
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

}
