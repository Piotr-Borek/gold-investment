<?php
namespace GoldInvestment\Model\GoldPrices;

class PeriodRepository
{
    /** @var  \DateTime */
    private $dayStart;

    /** @var  \DateTime */
    private $dayEnd;

    /**
     * @var Period
     */
    private $period;

    /**
     * @param \DateTime $dayStart
     * @param \DateTime $dayEnd
     * @return DayData[]
     */
    public function get(\DateTime $dayStart, \DateTime $dayEnd)
    {
        $this->period = new Period();
        $this->dayStart = $dayStart;
        $this->dayEnd = $dayEnd;

        $continue = 1;
        while ($continue) {
            $continue = $this->loadBatch();
        }

        return $this->period->getDayData();
    }

    private function loadBatch()
    {
        $dateNextYear = clone($this->dayStart);
        $dateNextYear->add(\DateInterval::createFromDateString('365 days'));
        if ($dateNextYear >= $this->dayEnd) {
            $dayEnd = $this->dayEnd;
            $continue = 0;
        } else {
            $dayEnd = $dateNextYear;
            $continue = 1;
        }

        $repo = new DayDataRepository();
        $os = $repo->get($this->dayStart, $dayEnd);
        foreach ($os as $o) {
            $this->period->addDayData($o);
        }

        $this->dayStart = $dayEnd->add(\DateInterval::createFromDateString('1 day'));

        return $continue;
    }

}
