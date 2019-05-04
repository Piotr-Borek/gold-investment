<?php
namespace GoldInvestment\Model;

use GoldInvestment\Model\GoldPrices\DayDataRepository;

class AnalysisService
{
    public function perform()
    {
        try {
            $repo = new DayDataRepository();
            $os = $repo->get(new \DateTime('2019-01-01'), new \DateTime('2019-04-01'));
        } catch (\Exception $e) {
            error_log($e);
            throw new \Exception("Wystąpił problem z pozyskaniem danych z NBP");
        }

    }

}
