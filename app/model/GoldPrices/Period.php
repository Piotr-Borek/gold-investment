<?php
namespace GoldInvestment\Model\GoldPrices;

class Period
{
    /** @var DayData[] */
    private $dayData = [];

    public function addDayData(DayData $o)
    {
        $this->dayData[$o->getDate()->format("Y-m-d")] = $o;
    }

    /**
     * @return DayData[]
     */
    public function getDayData()
    {
        return $this->dayData;
    }





}
