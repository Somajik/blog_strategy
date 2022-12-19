<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions //on enleve la partie creer un commentaires pour la partie admin et on remplace par index//
            ->remove(Crud::PAGE_INDEX, Action::NEW )
            ->remove(Crud::PAGE_INDEX, Action::EDIT);
    }
    public function configureFields(string $pageName): iterable
    {


        yield TextareaField::new('content', 'Contenu du commentaires');
        yield DateTimeField::new('created_at', 'Date de création');
        yield AssociationField::new('user', 'Login');
    }
}
