<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
           yield TextField::new('name',"Nom"),
           yield SlugField::new('slug')
                ->SetTargetFieldName('name'), //setTargetFieldName Ce champ utilise JavaScript pour générer dynamiquement le slug en fonction du contenu dun autre champ. Cette option définit le nom de la propriété de l'entité associée à ce champ //
            yield ColorField::new('color', 'Couleur'),
        ];
    }
    
}
