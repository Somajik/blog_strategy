<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable //yield a place de return//
    {
        yield TextField::new('title');

            yield SlugField::new('slug')
            ->setTargetFieldName('title');

        yield AssociationField::new('categories');

        yield TextEditorField::new('content');

        yield TextField::new('featuredText');

        yield ImageField::new('picture')
        ->setBasePath('uploads/')
        ->setUploadDir('public/uploads')
        ->setUploadedFileNamePattern('[slug]-[uuid].[extension]');// UUID unique id//
                                            //[timestamp]//



        yield DateTimeField::new('createdAt');
        

        yield DateTimeField::new('updateAt');
       

    }
    
}
