<?php

declare(strict_types = 1);

namespace Kauri\Loan;


interface PaymentScheduleInterface
{
    /**
     * PaymentScheduleInterface constructor.
     * @param PaymentScheduleConfigInterface $config
     */
    public function __construct(PaymentScheduleConfigInterface $config);

    /**
     * @param \DateTimeInterface $paymentDate
     * @param null|int $paymentSequenceNo
     */
    public function add(\DateTimeInterface $paymentDate, int $paymentSequenceNo = null): void;

    /**
     * @return PaymentScheduleConfigInterface
     */
    public function getConfig(): PaymentScheduleConfigInterface;

    /**
     * @return array
     */
    public function getPaymentDates(): array;

}