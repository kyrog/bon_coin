<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    private $articleRepository;
    private $em;

    public function __construct(ArticleRepository $articleRepository, EntityManagerInterface $em) {
        $this->articleRepository = $articleRepository;
        $this->em = $em;
    }
    /**
     * @Route("/articles", name="articles")
     */
    public function index(): Response
    {
        $articles = $this->articleRepository->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/article/{id}", name="article_by_id")
     */

    public function article($id): Response
    {
        $article = $this->articleRepository->find($id);
        return $this->render('article/article.html.twig', [
            'article' => $article,
        ]);
    }
}
