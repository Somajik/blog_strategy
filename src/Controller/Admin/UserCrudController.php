<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    

    


    public function configureFields(string $pageName): iterable
    {
        
           
        yield TextField::new('username',);
        // yield TextField::new('password')->onlyOnForms()
        // ->setFormType(PasswordType::class);// yield propre a easy admin//
        yield ChoiceField::new('roles')
        ->allowMultipleChoices()
        ->renderAsBadges([
            'ROLE_ADMIN' => 'success',
            'ROLE_AUTHOR' => 'warning',
            
        ])
        ->setChoices([
            'Administrateur' => 'ROLE_ADMIN',
            'Auteur' => 'ROLE_AUTHOR'
        ]);
    
    }
    
}
