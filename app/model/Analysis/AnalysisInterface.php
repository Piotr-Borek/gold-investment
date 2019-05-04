<?php
namespace GoldInvestment\Model\Analysis;

use GoldInvestment\Model\GoldPrices\DayData;

interface AnalysisInterface
{
    /**
     * @param DayData[] $data
     * @return mixed
     */
    public function setDayData($data);

    public function process();

    /**
     * @return Transaction[]
     */
    public function getTransactions();

}
