<?php

namespace App\Controller\Admin\Dashboard;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('category_name', 'Category Name'),
            Field::new('maximum_images_allowed', ' Max Images Allowed'),
            Field::new('post_validity_interval_in_days', 'Post Validity In Days'),
            AssociationField::new('parent', 'Parent Category'),
            AssociationField::new('subCategories', 'Child Categories'),
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
