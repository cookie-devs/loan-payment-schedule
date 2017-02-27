<?php

namespace Kauri\Loan\Test;


use Kauri\Loan\PaymentScheduleConfig;
use Kauri\Loan\PaymentScheduleFactory;
use PHPUnit\Framework\TestCase;

class PaymentScheduleFactoryTest extends TestCase
{
    /**
     * @dataProvider datesProvider
     * @param $noOfPayments
     * @param \DateTime $startDate
     * @param $dateIntervalPattern
     * @param array $dates
     */
    public function testGenerateSchedule($noOfPayments, \DateTime $startDate, $dateIntervalPattern, array $dates)
    {
        $config = new PaymentScheduleConfig($noOfPayments, $startDate, $dateIntervalPattern);
        $schedule = PaymentScheduleFactory::generate($config);
        $paymentDates = $schedule->getPaymentDates();

        /**
         * @var int $k
         * @var \DateTime $item
         */
        foreach ($paymentDates as $k => $item) {
            if ($item instanceof \DateTimeInterface) {
                $this->assertEquals($item->format('Y-m-d'), $dates[$k]);
            }
        }
    }

    public function datesProvider()
    {
        return [
            'P1D' => [3, new \DateTime('2000-01-01'), 'P1D', [1 => "2000-01-02", "2000-01-03", "2000-01-04"]],
            'P3D' => [3, new \DateTime('2000-01-01'), 'P3D', [1 => "2000-01-04", "2000-01-07", "2000-01-10"]],
            'P1M' => [3, new \DateTime('2000-01-01'), 'P1M', [1 => "2000-02-01", "2000-03-01", "2000-04-01"]],
        ];
    }

    /**
     * @dataProvider datesProvider
     * @param $noOfPayments
     * @param \DateTime $startDate
     * @param $dateIntervalPattern
     * @param array $dates
     */
    public function testFirstPaymentDate($noOfPayments, \DateTime $startDate, $dateIntervalPattern, array $dates)
    {
        $firstDate = new \DateTime(current($dates));
        $config = new PaymentScheduleConfig($noOfPayments, $startDate, $dateIntervalPattern, $firstDate);
        $schedule = PaymentScheduleFactory::generate($config);
        $paymentDates = $schedule->getPaymentDates();

        /**
         * @var int $k
         * @var \DateTime $item
         */
        foreach ($paymentDates as $k => $item) {
            if ($item instanceof \DateTimeInterface) {
                $this->assertEquals($item->format('Y-m-d'), $dates[$k]);
            }
        }

    }

}
