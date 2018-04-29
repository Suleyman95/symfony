<?php

namespace App\Controller;

use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use App\Entity\Article;

class ArticleController extends Controller
{
    /**
     * @Route("/", name="article_index")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $articles = $entityManager->getRepository(Article::class)->findAll();



        /*$article = new Article();
        $article->setName('doctrine');
        $article->setDescription('some text');
        $article->setCreatedAt(new \DateTime());

        $entityManager->persist($article);

        $entityManager->flush();*/

        return $this->render(
            'article/index.html.twig', array(
            'articles' => $articles
        ));
    }

    /**
     * @Route("/create", name="article_create")
     */
    public function createAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        //$articles = $entityManager->getRepository(Article::class)->findAll();
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render(
            'article/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/edit/{id}", name="article_edit")
     */
    public function editAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $id = $request->get('id');
        $article = $entityManager->getRepository(Article::class)->find($id);

        if (!$article) {
            return $this->render(
                'article/edit.html.twig', array(
                    'empty' => 'article is empty'
                ));
        }

        $editForm = $this->createForm(ArticleType::class, $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index', array('id' => $id));
        }

        return $this->render('article/edit.html.twig', array(
            'edit_form' => $editForm->createView()
        ));

    }

    /**
     * @Route("/delete/{id}", name="delete_article")
     */
    public function deleteAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = $entityManager->getRepository(Article::class)->find($id);
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('article_index');
    }
}
