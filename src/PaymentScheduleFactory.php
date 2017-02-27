<?php

declare(strict_types = 1);

namespace Kauri\Loan;

/**
 * Class PaymentScheduleFactory
 * @package Kauri\Loan
 */
class PaymentScheduleFactory implements PaymentScheduleFactoryInterface
{
    /**
     * @param PaymentScheduleConfigInterface $paymentScheduleConfig
     * @return PaymentScheduleInterface
     */
    public static function generate(PaymentScheduleConfigInterface $paymentScheduleConfig): PaymentScheduleInterface
    {
        $schedule = new PaymentSchedule($paymentScheduleConfig);

        $startDate = $paymentScheduleConfig->getStartDate();
        $dateInterval = $paymentScheduleConfig->getDateInterval();
        $noOfPayments = $paymentScheduleConfig->getNoOfPayments();
        $firstPaymentDate = $paymentScheduleConfig->getFirstPaymentDate();

        if (!is_null($firstPaymentDate)){
            $startDate = $firstPaymentDate;
            $schedule->add($startDate, 1);
        }

        $period = new \DatePeriod($startDate, $dateInterval, ($noOfPayments - $schedule->getNoOfPayments()));

        foreach ($period as $iteration => $date) {
            if ($date != $startDate) {
                $schedule->add($date, $schedule->getNoOfPayments() + 1);
            }
        }

        return $schedule;
    }
}