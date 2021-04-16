<?php

namespace App\Controller;

use App\Entity\SubArticle;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function test(Request $request)
    {
        $article = new SubArticle();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'added article');
        }
        return $this->render('base.html.twig', ['form' => $form->createView()]);
    }
}