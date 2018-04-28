<?php

namespace ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController extends AbstractController
{

    /**
     *
     * @Route("/info", name="info")
     */
    public function infoAction()
    {
        return $this->render(
            'ExampleBundle::index.html.twig',
            [
                'title' => "Welcome!"
            ]
        );
    }
}