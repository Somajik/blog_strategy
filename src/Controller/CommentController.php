<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Form\Type\CommentType;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @method User getUser() 
 */
class CommentController extends AbstractController
{
    #[Route('/comments/', name: 'comment_add')] //intercepter l'information avant l'article controller faire des requêtes vers le serveur sans recharger la page ;//
    public function add(Request $request,CommentRepository $commentRepository, ArticleRepository $articleRepository, UserRepository $userRepository, EntityManagerInterface $entityManagerInterface): Response //requete post//
    {

        $commentData = $request->request->all('comment');

       
        $article =$articleRepository->findOneBy(['id'=> $commentData['article']]);

        if(!$article) {
            return $this->json([
                'code' =>'ARTICLE_NOT_FOUND'

            ],Response::HTTP_BAD_REQUEST);
        }

        $comment = new Comment($article);
        

        $comment->setContent($commentData['content']);
        // $comment->setUser($userRepository->findOneBy(['id']));
        if ($this->getUser()){
            $comment->setUser($this->getUser());
        }
        $comment->setCreatedAt(new \DateTime());

        $entityManagerInterface->persist($comment);
        $entityManagerInterface->flush();// pour inserer dans la base de données//
        

        $html = $this->renderView('comment/index.html.twig',[
            'comment'=> $comment
            
        ]);
        $commentForm = $this->createForm(CommentType::class, $comment);

        return $this->redirectToRoute('article_show', ['id'=>$article->getId(),'article' => $article,'commentForm'=>$commentForm]);


        // return $this->json([
        //     'code'=>'COMMENT_ADDED_SUCESSFULLY',
        //     'message'=> $html,
        //     "numberOfComments"=> $commentRepository->count([ 'article' => $article])
        // ]);
    }
}
