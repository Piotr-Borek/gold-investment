<?php
namespace GoldInvestment\Tests;

use GoldInvestment\Model\Analysis\BiggestNominalAnalysis;
use GoldInvestment\Model\GoldPrices\DayData;
use PHPUnit\Framework\TestCase;

class BiggestNominalAnalysisTest extends TestCase
{
    /** @var  DayData[] */
    private $dayData = [];

    public function setUp()
    {
        $this->dayData = [
            new DayData(new \DateTime('2012-01-01'), 100),
            new DayData(new \DateTime('2012-01-02'), 120),
            new DayData(new \DateTime('2012-01-03'), 90),
            new DayData(new \DateTime('2012-01-04'), 110),
            new DayData(new \DateTime('2012-01-05'), 130),
            new DayData(new \DateTime('2012-01-06'), 160),
            new DayData(new \DateTime('2012-01-07'), 155),
        ];
    }

    public function testProcess()
    {
        $analysis = new BiggestNominalAnalysis();
        $analysis->setDayData($this->dayData);
        $analysis->process();
        $os = $analysis->getTransactions();

        $this->assertEquals(2, count($os));
        $this->assertEquals("BUY", $os[0]->getCategory());
        $this->assertEquals("2012-01-03", $os[0]->getDay()->format("Y-m-d"));
        $this->assertEquals("SELL", $os[1]->getCategory());
        $this->assertEquals("2012-01-06", $os[1]->getDay()->format("Y-m-d"));
    }

}
