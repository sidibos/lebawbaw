<?php

namespace App\Controller\Admin\Dashboard;

use App\Entity\County;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CountyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return County::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('county_name'),
            AssociationField::new('city')
        ];
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
