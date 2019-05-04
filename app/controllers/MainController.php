<?php
namespace GoldInvestment\Controllers;

class MainController
{
    public function mainPage(\Slim\Slim $app, \Twig_Environment $twig)
    {
        echo $twig->render('main.html', array());
    }

    public function analysisPage(\Slim\Slim $app, \Twig_Environment $twig)
    {
        echo $twig->render('analysis.html', array());
    }

}
