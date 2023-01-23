<?php

namespace App\Controller;

use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ArticleController extends AbstractController
{

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function index()
    {
        $articles = R::findAll('article');
        self::render('articles/articles.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @throws SQL
     */
    public static function addArticle()
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

    /**
     */

    public static function delete(int $id = null)
    {
        if (null === $id) {
            header("Location: /?c=home");
            exit();
        }

        $article = R::findOne('article', 'id=?', [$id]);

        if ($article) {
            R::trash($article);
            header("Location: /?c=article");
            exit();
        }
        else {
            header("Location: /?c=article");
        }

    }
}