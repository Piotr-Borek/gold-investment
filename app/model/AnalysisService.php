<?php
namespace GoldInvestment\Model;

use GoldInvestment\Model\Analysis\BiggestNominalAnalysis;
use GoldInvestment\Model\GoldPrices\DayDataRepository;

class AnalysisService
{
    /**
     * @return Analysis\Transaction[]
     * @throws \Exception
     */
    public function perform()
    {
        try {
            $repo = new DayDataRepository();
            $os = $repo->get(new \DateTime('2019-01-01'), new \DateTime('2019-04-01'));
        } catch (\Exception $e) {
            error_log($e);
            throw new \Exception("Problem with getting data from NBP.");
        }

        try {
            $analysis = new BiggestNominalAnalysis();
            $analysis->setDayData($os);
            $analysis->process();

            return $analysis->getTransactions();
        } catch (\Exception $e) {
            error_log($e);
            throw new \Exception("Problem with internal processing data.");
        }
    }
}
