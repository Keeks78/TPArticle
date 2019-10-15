<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="articles_liste")
     */
    public function listeArticles(ArticleRepository $repo)
    {
        //chercher l'ensemble des articles et on le stock
        $articles=$repo->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $articles //on va le donner dans twig
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_affiche")
     */
    public function afficheArticle(Article $article)
    {
        return $this->render('article/afficheArticle.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/tableau", name="tableau_article")
     */
    public function tableauArticles(ArticleRepository $repo)
    {
        //Prendre l'ensemble des articles sous forme de tableau
        $articles=$repo->findAll();
        return $this->render('article/tableau.html.twig', [
            'articles' => $articles //on va le donner dans le twig
        ]);
    }

    /**
     * Permet de créer un article
     * 
     * @Route("/articles/new", name="articles_create")
     * 
     * @return Response
     */
    public function create(){
        $article = new Article();

        $form = $this->createFormBuilder($article)
                    ->add('libelle')
                    ->add('prix')
                    ->add('description')
                    ->add('save', SubmitType::class, [
                        'label' => 'Créer ',
                        'attr' => [
                            'class' => 'btn btn-primary'
                        ]
                    ])
                    ->getForm();

        return $this->render('article/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * Permet d'afficher une seule annonce  
     *
     * @Route("/ads/{slug}", name="ads_show")
     * 
     * @return Response
     */
    public function show(Article $article){
        return $this->render('article/show.html.twig', [
          'article' => $article
      ]);
  }
    
}
