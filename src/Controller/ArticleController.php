<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\Type\CommentType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(Article $article): Response
    {
        if(!$article) {
            //si le variable article n'existe pas on retourne a la page home//
            return $this->redirectToRoute('app_home');
        }
        
        $commentForm = $this->createForm(CommentType::class);

        return $this->renderForm('article/show.html.twig', [
            'article' => $article,
            'commentForm'=>$commentForm,
        ]);
    }
}
