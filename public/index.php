<?php
error_reporting(E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", "../logs/".date("Y-m-d")."-error.log");

session_start();

include "../vendor/autoload.php";

$app = new \Slim\Slim(array());

$loader = new Twig_Loader_Filesystem('../app/templates');
$twig = new Twig_Environment($loader, []);

include "../app/routing.php";
\GoldInvestment\routing($app, $twig);

$app->run();