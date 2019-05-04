<?php
namespace GoldInvestment\Model\Analysis;

use GoldInvestment\Model\GoldPrices\DayData;

class BiggestNominalAnalysis implements AnalysisInterface
{
    /** @var DayData[]  */
    private $dayData = [];

    /** @var Transaction[] */
    private $transactions = [];

    private $currentBiggestProfit;

    /** @var DayData */
    private $currentDayBuy;
    /** @var  DayData */
    private $currentDaySell;

    public function setDayData($data)
    {
        $this->dayData = $data;
    }

    public function process()
    {
        foreach ($this->dayData as $d1) {
            foreach ($this->dayData as $d2) {
                $this->processTwoDays($d1, $d2);
            }
        }

        if ($this->currentBiggestProfit > 0) {
            $this->transactions[] = new Transaction($this->currentDayBuy->getDate(), "BUY", $this->currentDayBuy->getPrice());
            $this->transactions[] = new Transaction($this->currentDaySell->getDate(), "SELL", $this->currentDaySell->getPrice());
        }
    }

    private function processTwoDays(DayData $d1, DayData $d2)
    {
        if ($d2->getDate() <= $d1->getDate()) {
            return;
        }
        $profit = $d2->getPrice() - $d1->getPrice();
        if ($profit > $this->currentBiggestProfit) {
            $this->currentBiggestProfit = $profit;
            $this->currentDayBuy = $d1;
            $this->currentDaySell = $d2;
        }
    }

    public function getTransactions()
    {
        return $this->transactions;
    }

}
