<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\State;
use App\Entity\City;
use App\Entity\County;
use App\Entity\User;
use App\Entity\Post;
use App\Entity\Role;
use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Country;
use App\Entity\Currency;
use App\Entity\PostAttribute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminDashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();
        return $this->render('admin/my-dashboard.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Lebawbaw');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Add User', 'fa fa-user', User::class)->setAction('new');

        yield MenuItem::linkToCrud('Posts', 'fa fa-comments', Post::class);
        yield MenuItem::linkToCrud('Add Post', 'fa fa-comments', Post::class)->setAction('new');

        yield MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class);
        yield MenuItem::linkToCrud('Add Category', 'fa fa-tags', Category::class)->setAction('new');

        yield MenuItem::linkToCrud('Languages', 'fa fa-tags', Language::class);
        yield MenuItem::linkToCrud('Add Language', 'fa fa-tags', Language::class)->setAction('new');

        yield MenuItem::linkToCrud('Countries', 'fa fa-tags', Country::class);
        yield MenuItem::linkToCrud('Add Country', 'fa fa-tags', Country::class)->setAction('new');

        yield MenuItem::linkToCrud('Currencies', 'fa fa-tags', Currency::class);
        yield MenuItem::linkToCrud('Add Currency', 'fa fa-tags', Currency::class)->setAction('new');

        yield MenuItem::linkToCrud('Cities', 'fa fa-tags', City::class);
        yield MenuItem::linkToCrud('Add City', 'fa fa-tags', City::class)->setAction('new');

        yield MenuItem::linkToCrud('Counties', 'fa fa-tags', County::class);
        yield MenuItem::linkToCrud('Add County', 'fa fa-tags', County::class)->setAction('new');

        yield MenuItem::linkToCrud('States', 'fa fa-tags', State::class);
        yield MenuItem::linkToCrud('Add State', 'fa fa-tags', State::class)->setAction('new');

        yield MenuItem::linkToCrud('Post Attributes', 'fa fa-tags', PostAttribute::class);
        yield MenuItem::linkToCrud('Add PostAttribute', 'fa fa-tags', PostAttribute::class)->setAction('new');

        yield MenuItem::linkToCrud('Roles', 'fa fa-tags', Role::class);
        yield MenuItem::linkToCrud('Add Role', 'fa fa-tags', Role::class)->setAction('new');

       // yield MenuItem::linkToLogout('Logout', 'fa fa-exit');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
