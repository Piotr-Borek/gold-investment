<?php
namespace GoldInvestment\Controllers;

use GoldInvestment\Model\AnalysisMethodService;
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
            $analysis = AnalysisMethodService::getAnalysis(!empty($_GET["method"]) ? $_GET["method"] : null);
            $service = new AnalysisService();
            $transactions = $service->perform($analysis);
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
        }




        echo $twig->render('analysis.html', array(
            "errors" => $errors,
            "transactions" => json_decode(json_encode($transactions), true),
        ));
    }

}
