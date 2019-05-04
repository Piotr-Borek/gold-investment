<?php
namespace GoldInvestment\Tests;

use GoldInvestment\Model\GoldPrices\DayDataRepository;
use PHPUnit\Framework\TestCase;

class GoldPricesDayDataRepositoryTest extends TestCase
{
    public function setUp()
    {

    }

    public function testGet()
    {
        $repo = new DayDataRepository();
        $os = $repo->get(new \DateTime('2019-01-02'), new \DateTime('2019-01-03'));

        $this->assertEquals(2, count($os));
        $this->assertEquals(15518, $os[1]->getPrice());
    }

}
