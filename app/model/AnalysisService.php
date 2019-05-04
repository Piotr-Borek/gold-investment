<?php
namespace GoldInvestment\Model;

use GoldInvestment\Model\Analysis\AnalysisInterface;
use GoldInvestment\Model\Analysis\BiggestNominalAnalysis;
use GoldInvestment\Model\GoldPrices\PeriodRepository;

class AnalysisService
{
    /**
     * @param AnalysisInterface $analysis
     * @return Analysis\Transaction[]
     * @throws \Exception
     */
    public function perform(AnalysisInterface $analysis)
    {
        try {
            $now = new \DateTime();
            $startTime = clone($now);
            $startTime->sub(\DateInterval::createFromDateString('5 years'));

            $repo = new PeriodRepository();
            $os = $repo->get($startTime, $now);
        } catch (\Exception $e) {
            error_log($e);
            throw new \Exception("Problem with getting data from NBP.");
        }

        try {
            $analysis->setDayData($os);
            $analysis->process();

            return $analysis->getTransactions();
        } catch (\Exception $e) {
            error_log($e);
            throw new \Exception("Problem with internal processing data.");
        }
    }
}
