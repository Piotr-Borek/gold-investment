<?php
namespace GoldInvestment\Model;

use GoldInvestment\Model\Analysis\BiggestNominalAnalysis;
use GoldInvestment\Model\Analysis\BiggestRelativeAnalysis;

class AnalysisMethodService
{
    public static function getAnalysis($method)
    {
        if ($method == "relative") {
            return new BiggestRelativeAnalysis();
        } elseif ($method == "nominal") {
            return new BiggestNominalAnalysis();
        } else {
            throw new \Exception("Unknown method: ". $method);
        }
    }

}
