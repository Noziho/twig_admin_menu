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

    public static function addArticle ()
    {
        if (isset($_POST['submit'])) {
            if (!self::formIsset('article_title', 'article_content')) {
                header("Location: /?c=home&f=missinng");
            }

            $article = R::dispense('article');
            $article->articleTitle = filter_var($_POST['article_title'], FILTER_SANITIZE_STRING);
            $article->articleContent = filter_var($_POST['article_content'], FILTER_SANITIZE_STRING);

            R::store($article);

            header("Location: /?c=home&f=sucess");
        }


    }
}