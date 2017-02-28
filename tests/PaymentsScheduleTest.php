<?php

namespace Kauri\Loan\Test;


use Kauri\Loan\PaymentScheduleConfig;
use Kauri\Loan\PaymentSchedule;
use Kauri\Loan\PaymentScheduleFactory;
use PHPUnit\Framework\TestCase;

class PaymentsScheduleTest extends TestCase
{
    /**
     * @dataProvider datesProvider
     * @param $paymentDate
     */
    public function testPaymentsSchedule($paymentDate)
    {
        $startDate = new \DateTime();
        $config = new PaymentScheduleConfig(3, $startDate, 'P1D');

        $paymentSchedule = new PaymentSchedule($config);
        $paymentSchedule->add($paymentDate);

        $this->assertEquals(1, $paymentSchedule->getNoOfPayments());

        foreach ($paymentSchedule->getPaymentDates() as $date) {
            $this->assertEquals($date, $paymentDate);
        }
    }

    public function testPaymentScheduleConfig()
    {
        $noOfPayments = 3;
        $startDate = new \DateTime();
        $firstPaymentDate = new \DateTime();
        $config = new PaymentScheduleConfig($noOfPayments, $startDate, 'P1D', $firstPaymentDate);

        $this->assertEquals(1, $config->getAverageIntervalLength());

        $schedule = PaymentScheduleFactory::generate($config);

        $this->assertEquals($schedule->getNoOfPayments(), $noOfPayments);
        $this->assertEquals($noOfPayments, $schedule->getConfig()->getNoOfPayments());
    }

    public function datesProvider()
    {
        return [
            [new \DateTime()]
        ];
    }
}
