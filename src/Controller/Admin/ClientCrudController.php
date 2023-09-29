<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }


    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom')->setRequired(true);
        yield TextField::new('prenom')->setRequired(true);
        yield AssociationField::new('user')
            ->renderAsEmbeddedForm(UserCrudController::class);

    }

}



