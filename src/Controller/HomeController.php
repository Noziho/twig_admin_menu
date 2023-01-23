<?php

namespace App\Controller;

use RedBeanPHP\R;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends AbstractController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index()
    {
        $this->render('home/home.html.twig', []);
    }
}