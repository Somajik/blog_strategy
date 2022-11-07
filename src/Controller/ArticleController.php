<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(Article $article): Response
    {
        if(!$article) {
            //si le variable article n'existe pas on retourne a la page home//
            return $this->redirectToRoute('app_home');}
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
