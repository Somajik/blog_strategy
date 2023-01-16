<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Entity\Article;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class ArticleCrudController extends AbstractCrudController
{
/**
 * @IsGranted("ROLE_ADMIN")
 */
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle(Crud::PAGE_INDEX, 'Articles');
    }

    
    public function configureFields(string $pageName): iterable //yield a place de return//
    {
        yield TextField::new('title','Titre');

            yield SlugField::new('slug')
            ->setTargetFieldName('title');
            
            yield AssociationField::new('user','Auteur')
            ->setFormTypeOption('query_builder', function (UserRepository $entityRepository) {
            return $entityRepository->createQueryBuilder('user')
            ->Where('user.roles LIKE :roleAdmin')
            ->setParameter('roleAdmin','%ROLE_ADMIN%')
            ->orWhere('user.roles LIKE :roleAuthor')
            ->setParameter('roleAuthor','%ROLE_AUTHOR%')
            ->andWhere('user.Status = :userStatus')
            ->setParameter('userStatus',true);
        });
       


        // yield AssociationField::new('user','Auteur')
        // ->setQueryBuilder(
        //     fn(QueryBuilder $queryBuilder)=> $queryBuilder->addSelect('user')
        //         ->from(User::class,'user')
        //         ->Where('user.roles = :roleAdmin')
        //         ->setParameter('roleAdmin','["ROLE_ADMIN"]')
        //                ); // pour selectionnare les roles admin et auteur dans le champs auteur //
       

        yield AssociationField::new('categories', 'Catégories');

        yield TextEditorField::new('content', 'Contenu');

        yield TextField::new('featuredText', 'Description');

        yield ImageField::new('picture','Image')
        ->setBasePath('uploads/')
        ->setUploadDir('public/uploads')
        ->setUploadedFileNamePattern('[slug]-[uuid].[extension]');// UUID unique id//
                                            //[timestamp]//

        
        yield DateTimeField::new('createdAt','Date de création')
        
        
        ;
        

        yield DateTimeField::new('updateAt', 'Date de mise à jour');

        
       

    }
    
}
