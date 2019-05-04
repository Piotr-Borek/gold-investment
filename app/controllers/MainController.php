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
        $errors = [];
        $transactions = [];
        try {
            $service = new AnalysisService();
            $transactions = $service->perform();
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
        }


        echo $twig->render('analysis.html', array(
            "errors" => $errors,
            "transactions" => json_decode(json_encode($transactions), true),
        ));
    }

}
