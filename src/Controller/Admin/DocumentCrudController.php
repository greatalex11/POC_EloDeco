<?php

namespace App\Controller\Admin;

use App\Entity\Document;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DocumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Document::class;
    }


    public function configureFields(string $pageName): iterable
    {

        yield TextField::new('designation');
        yield TextField::new('chemin');
        yield ImageField::new('filename')
            ->setBasePath('assets/alex/')
            ->setUploadDir("/public/assets/alex/");
//            ->setFormTypeOptions(
//                'constraints' => [
//                'maxSize' => '5M',
//                'mimeTypes' => 'application/pdf',
//            ]);

    }

}


//
//            ->setFormTypeOption([
//                'maxSize' => '5M'
//                'mimeTypes' => [
//                    'application/pdf',
//                    'application/x-pdf',
//                    'image/jpeg',
//                    'image/png',
//                ],
//            ]);

//        $Document = "";
//        $form = $this->createForm(DocumentType::class, $Document);
//        //$formview = $form->createView();
//
//        return $this->render('', [
//            'form' => $form,
//        ]);

// return [idfield::new('id')->hideOnForm(),
//        TextField::new('designation'),
//        Field::new('chemin'),
//        Field::new('filename')];

