<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceLabel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle(Crud::PAGE_INDEX, 'Gestion des Utilisateurs');
    }

    public function configureActions(Actions $actions): Actions
    {
    return $actions
    
          ->remove(Crud::PAGE_INDEX, Action::NEW)
          
     ;
    }

    


    public function configureFields(string $pageName): iterable
    {     
        yield TextField::new('username','Login');
   
        yield ChoiceField::new('roles','Statut')
        ->allowMultipleChoices()
        ->renderAsBadges([
            'ROLE_ADMIN' => 'success',
            'ROLE_AUTHOR' => 'warning',
            'ROLE_USER' => 'secondary',
            
        ])
        ->setChoices([
            'Administrateur' => 'ROLE_ADMIN',
            'Auteur' => 'ROLE_AUTHOR',
            'User' => 'ROLE_USER'
        ]);



        yield BooleanField::new('status','activer le compte')
        ->renderAsSwitch(true);
    }
    
}
