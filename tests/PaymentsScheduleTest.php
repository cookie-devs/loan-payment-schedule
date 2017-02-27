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
        $startDate = new \DateTime();
        $firstPaymentDate = new \DateTime();
        $config = new PaymentScheduleConfig(3, $startDate, 'P1D', $firstPaymentDate);

        $schedule = PaymentScheduleFactory::generate($config);

        $this->assertEquals($schedule->getNoOfPayments(), 3);
    }

    public function datesProvider()
    {
        return [
            [new \DateTime()]
        ];
    }
}
