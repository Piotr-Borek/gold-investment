<?php
namespace GoldInvestment;

use GoldInvestment\Controllers\MainController;

function routing(\Slim\Slim $app, \Twig_Environment $twig)
{
    $app->get('/', function () use ($app, $twig) {
        $c = new MainController();
        $c->mainPage($app, $twig);
    });
}

