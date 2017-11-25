<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Forms\FormType;
use AppBundle\Utils\Persistence;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
            'news' => Persistence::getInstance()->findAll($this->getDoctrine()),
        ]);
    }

    /**
     * @Route("/post/{alias}")
     */
    public function articleAction($alias)
    {
        return $this->render('default/preview.html.twig', [
            'news' => Persistence::getInstance()->findOneBy(
                $alias, $this->getDoctrine()
            ),
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
            $arr = explode( ',', $request->request->all()['form']['tagsText']);

            if (count($arr) > 3) {
                throw new HttpNotFoundException('More than three tags can not be');
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($news);
                $em->flush();

                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render('default/add-post.html.twig', [
            'form_add' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{alias}")
     */
    public function editAction($alias, Request $request)
    {
        $news = Persistence::getInstance()->findOneBy(
            $alias, $this->getDoctrine()
        );

        $form = $this->createForm(FormType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arr = explode( ',', $request->request->all()['form']['tagsText']);

            if (count($arr) > 3) {
                throw new HttpNotFoundException('More than three tags can not be');
            } else {
                $em = $this->getDoctrine()->getManager();
                $em->persist($news);
                $em->flush();

                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render('default/edit-post.html.twig', [
            'form_edit' => $form->createView(),
        ]);
    }
}