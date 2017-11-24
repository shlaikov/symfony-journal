<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Forms\FormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => 'index page',
        ]);
    }

    /**
     * @Route("/post/{alias}")
     */
    public function articleAction($alias)
    {
        $em = $this->getDoctrine();
        $newsRepository = $em->getRepository(News::class);

        $news = $newsRepository->findOneBy([
            'alias' => $alias
        ]);

        return $this->render('default/preview.html.twig', [
            'news' => $news,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function addAction(Request $request)
    {
        $news = new News();
        $form = $this->createForm(FormType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/add-post.html.twig', [
            'form_add' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{alias}", requirements={"alias" = "\d+"})
     */
    public function editAction($alias)
    {
        $news = new News();
        $form = $this->createForm(FormType::class, $news);

        return $this->render('default/edit-post.html.twig', [
            'form_edit' => $form->createView(),
        ]);
    }
}