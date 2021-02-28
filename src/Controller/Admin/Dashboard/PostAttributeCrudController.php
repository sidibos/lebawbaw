<?php

namespace App\Controller\Admin\Dashboard;

use App\Entity\PostAttribute;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostAttributeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PostAttribute::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
