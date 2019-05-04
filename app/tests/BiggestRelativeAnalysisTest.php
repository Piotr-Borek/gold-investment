<?php
namespace GoldInvestment\Tests;

use GoldInvestment\Model\Analysis\BiggestNominalAnalysis;
use GoldInvestment\Model\Analysis\BiggestRelativeAnalysis;
use GoldInvestment\Model\GoldPrices\DayData;
use PHPUnit\Framework\TestCase;

class BiggestRelativeAnalysisTest extends TestCase
{
    /** @var  DayData[] */
    private $dayData = [];

    public function setUp()
    {
        $this->dayData = [
            new DayData(new \DateTime('2012-01-01'), 90),
            new DayData(new \DateTime('2012-01-02'), 180),
            new DayData(new \DateTime('2012-01-03'), 60),
            new DayData(new \DateTime('2012-01-04'), 130),
            new DayData(new \DateTime('2012-01-05'), 130),
            new DayData(new \DateTime('2012-01-06'), 120),
            new DayData(new \DateTime('2012-01-07'), 115),
        ];
    }

    public function testProcess()
    {
        $analysis = new BiggestRelativeAnalysis();
        $analysis->setDayData($this->dayData);
        $analysis->process();
        $os = $analysis->getTransactions();

        $this->assertEquals(2, count($os));
        $this->assertEquals("BUY", $os[0]->getCategory());
        $this->assertEquals("2012-01-03", $os[0]->getDay()->format("Y-m-d"));
        $this->assertEquals("SELL", $os[1]->getCategory());
        $this->assertEquals("2012-01-04", $os[1]->getDay()->format("Y-m-d"));
    }

}
