<?php

namespace App\Controller\Admin;

use App\Entity\Profile;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProfileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Profile::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('id')->onlyOnIndex(),
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom'),
            TextField::new('jobTitle', 'Emploi'),
            NumberField::new('position', 'Position'),
            EmailField::new('email', ),
            TextField::new('tel')->onlyOnForms(),
            TextField::new('address', 'Adresse')->onlyOnForms(),
            TextField::new('postalCode', 'Code postal')->onlyOnForms(),
            TextField::new('city', 'Ville')->onlyOnForms(),
            DateField::new('apsideBirthday', 'Date anniversaire Apside'),
            DateField::new('creationDate', 'Créé le')->onlyOnIndex(),
            DateField::new('lastUpdateDate', 'Dernière MàJ')->onlyOnIndex(),
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
