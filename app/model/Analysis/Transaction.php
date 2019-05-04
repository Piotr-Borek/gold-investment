<?php
namespace GoldInvestment\Model\Analysis;

class Transaction
{
    /**
     * @var  \DateTime
     */
    private $day;

    /**
     * BUY or SELL
     * @var string
     */
    private $category;

    /**
     * Transaction constructor.
     * @param \DateTime $day
     * @param $category
     */
    public function __construct(\DateTime $day, $category)
    {
        $this->day = $day;
        $this->category = $category;
    }

    /**
     * @return \DateTime
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }
}
