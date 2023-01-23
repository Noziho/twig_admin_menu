<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    private static ?Environment $twigInstance = null;
    private static ?FilesystemLoader $twigLoader = null;

    /**
     * @param ...$params
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public static function render (...$params): void
    {
        try {
            echo self::getTwig()->render(...$params);
        }
        catch (LoaderError $e) {
            echo self::getTwig()->render('error/404.html.twig');
        }
        catch (RuntimeError | SyntaxError $e) {
            echo self::getTwig()->render('error/500.html.twig');

        }
    }
    /**
     * Return Twig instance.
     * @return Environment
     */
    public static function getTwig(): Environment
    {
        if (null === self::$twigInstance) {
            if (null === self::$twigLoader) {
                self::$twigLoader = new FilesystemLoader('../templates');
            }
            self::$twigInstance = new Environment(self::$twigLoader, [
                'debug' => true,
                'strict_variables' => true,
                'cache' => '../var/cache',
            ]);

            self::$twigInstance->addExtension(new DebugExtension());
        }

        return self::$twigInstance;
    }

    /**
     * Return the current Twig loader.
     * @return FilesystemLoader|null
     */
    public function getTwigLoader (): ?FilesystemLoader
    {
        return self::$twigLoader;
    }

    public abstract function index ();


    public static function formIsset(...$inputNames): bool
    {
        foreach ($inputNames as $name) {
            if (!isset($_POST[$name]) || empty($_POST[$name])) {
                return false;
            }
        }
        return true;
    }


}