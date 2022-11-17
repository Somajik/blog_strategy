<?php

namespace App\Form\Type;


use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
       $builder //constructeur//
            ->add('content', TextareaType::class, [
                'label' => 'Votre message'
            ])

            ->add('article', HiddenType::class)// champs caché pour rattaché un commentaire a un article//
            ->add('send',SubmitType::class, [
                'label' => 'Envoyer'
            ]
            );
            $builder->get('article')
            ->addModelTransformer(new CallbackTransformer(
                //FN fonction fléché Les fonctions fléchées ont accès à toutes les variables de la portée dans laquelle elles ont été créées. fn(arguments) => expression to be returned; ici pour recuperer l'id et le titre de l'artcle comme valeur ainsi pour associer les commentaire et articles //

                fn (Article $article) => $article->getId(),//pour remplacer la valeur id qui permet de ne pas afficher le titre de l'article et vers le lien dans la base de donnés par rapport a l'ID//
                fn (Article $article) => $article->getTitle()));
    }
    public function configureOptions(OptionsResolver $resolver)
    {  
      $resolver->setDefaults([//objet de type comment//
        'data_class' => Comment::class,
        'csrf_token_id'=> 'comment-add'
      ]);
    }
}