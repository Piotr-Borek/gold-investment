<?php
namespace GoldInvestment\Controllers;

class MainController
{
    public function mainPage(\Slim\Slim $app, \Twig_Environment $twig)
    {
        echo $twig->render('main.html', array());
    }

}
