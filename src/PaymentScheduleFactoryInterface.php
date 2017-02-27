<?php

declare(strict_types = 1);

namespace Kauri\Loan;


interface PaymentScheduleFactoryInterface
{
    /**
     * PaymentDateCalculatorInterface constructor.
     * @param PaymentScheduleConfigInterface $config
     * @return PaymentScheduleInterface
     */
    public static function generate(PaymentScheduleConfigInterface $config): PaymentScheduleInterface;
}