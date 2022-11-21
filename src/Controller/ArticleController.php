<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\Type\CommentType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'article_show')]
    /*
    * @ParamConverter("article", options={"id" = "article_id"})
    */
    public function show($id , Article $article): Response
    {
        if(!$article) {
            //si le variable article n'existe pas on retourne a la page home//
            return $this->redirectToRoute('app_home');
        }
        
       
        $comment = new Comment($article); //pour mettre en relation un nouveau commentaire a un article //

        $commentForm = $this->createForm(CommentType::class, $comment);
        
       
        return $this->renderForm('article/show.html.twig', [
            'article' => $article,
            'commentForm'=> $commentForm,
        ]);
    }
}
