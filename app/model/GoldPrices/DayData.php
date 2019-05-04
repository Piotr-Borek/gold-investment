<?php
namespace GoldInvestment\Model\GoldPrices;

class DayData
{
    /**
     * @var  \DateTime
     */
    private $date;
    /**
     * in "grosze"
     * @var integer
     */
    private $price;

    /**
     * DayData constructor.
     * @param \DateTime $date
     * @param $price
     */
    public function __construct(\DateTime $date, $price)
    {
        $this->date = $date;
        $this->price = $price;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
}
