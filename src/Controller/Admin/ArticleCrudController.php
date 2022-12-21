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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ArticleCrudController extends AbstractCrudController
{
/**
 * @IsGranted("ROLE_ADMIN")
 */
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable //yield a place de return//
    {
        yield TextField::new('title','Titre');

            yield SlugField::new('slug')
            ->setTargetFieldName('title');

        yield AssociationField::new('categories', 'Catégories');

        yield TextEditorField::new('content', 'Contenu');

        yield TextField::new('featuredText', 'Description');

        yield ImageField::new('picture','Image')
        ->setBasePath('uploads/')
        ->setUploadDir('public/uploads')
        ->setUploadedFileNamePattern('[slug]-[uuid].[extension]');// UUID unique id//
                                            //[timestamp]//


        yield AssociationField::new('user','Auteur');
        
        yield DateTimeField::new('createdAt','Date de création');
        

        yield DateTimeField::new('updateAt', 'Date de mise à jour');

        
       

    }
    
}
