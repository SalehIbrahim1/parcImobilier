<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Entity\Cite;
use App\Entity\User;
use App\Entity\Daira;
use App\Entity\Commune;
use App\Entity\Contrat;
use App\Entity\Batiment;
use App\Entity\Payement;
use App\Entity\Locataire;
use App\Controller\Admin\DairaCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Security\Permission;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Security\Http\Logout\LogoutUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use function Symfony\Component\Translation\t;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(DairaCrudController::class)->generateUrl();

        return $this->redirect($url);

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
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setLocales([
                'en' => '🇬🇧 English',
                'fr' => '🇫🇷 Français'
            ])
            ->setTitle('Parc');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Daira', 'fas fa-list', Daira::class);
        yield MenuItem::linkToCrud('Commune', 'fas fa-list', Commune::class);
        yield MenuItem::linkToCrud('Cités', 'fa-solid fa-city', Cite::class);
        yield MenuItem::linkToCrud('Batiments', 'fas fa-list', Batiment::class);
        yield MenuItem::linkToCrud('Biens', 'fa-solid fa-parachute-box', Bien::class);
        yield MenuItem::linkToCrud('Locataires', 'fa-solid fa-people-roof', Locataire::class);
        yield MenuItem::linkToCrud('Contrats', 'fa-solid fa-handshake', Contrat::class);
        yield MenuItem::linkToCrud('Payement', 'fa-solid fa-sack-dollar', Payement::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-user', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        $userMenuItems = [];

        if (class_exists(LogoutUrlGenerator::class)) {
            $userMenuItems[] = MenuItem::section();
            $userMenuItems[] = MenuItem::linkToLogout(t('user.sign_out', domain: 'EasyAdminBundle'), 'fa-sign-out');

        }
        if ($this->isGranted(Permission::EA_EXIT_IMPERSONATION)) {
            $userMenuItems[] = MenuItem::linkToExitImpersonation(t('user.exit_impersonation', domain: 'EasyAdminBundle'), 'fa-user-lock');
        }

        $userName = '';
        if (method_exists($user, '__toString')) {
            $userName = (string) $user;
        } elseif (method_exists($user, 'getUserIdentifier')) {
            $userName = $user->getUserIdentifier();
        } elseif (method_exists($user, 'getUsername')) {
            $userName = $user->getUsername();
        }

        return UserMenu::new()
            ->displayUserName()
            ->displayUserAvatar()
            
            ->setName($userName)
            ->setAvatarUrl("/images/".$user->getAvatar())
            ->setMenuItems($userMenuItems);
    }
}
