<?php

namespace App\Controller\Admin;

use App\Entity\Taches;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TachesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Taches::class;
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
