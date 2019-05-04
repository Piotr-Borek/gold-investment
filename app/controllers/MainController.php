<?php
namespace GoldInvestment\Controllers;

use GoldInvestment\Model\AnalysisService;

class MainController
{
    public function mainPage(\Slim\Slim $app, \Twig_Environment $twig)
    {
        echo $twig->render('main.html', array());
    }

    public function analysisPage(\Slim\Slim $app, \Twig_Environment $twig)
    {
        $service = new AnalysisService();
        $service->perform();

        echo $twig->render('analysis.html', array());
    }

}
