<?php

declare(strict_types = 1);

namespace Kauri\Loan;

/**
 * Class PaymentSchedule
 * @package Kauri\Loan
 */
class PaymentSchedule implements PaymentScheduleInterface
{
    /**
     * @var array
     */
    private $paymentDates = array();

    /**
     * @var PaymentScheduleConfigInterface
     */
    private $config;

    /**
     * PaymentSchedule constructor.
     * @param PaymentScheduleConfigInterface $config
     */
    public function __construct(PaymentScheduleConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @param \DateTimeInterface $paymentDate
     * @param null|int $paymentSequenceNo
     */
    public function add(\DateTimeInterface $paymentDate, int $paymentSequenceNo = null): void
    {
        $this->paymentDates[$paymentSequenceNo] = $paymentDate;
    }

    /**
     * @return array
     */
    public function getPaymentDates(): array
    {
        return $this->paymentDates;
    }

    /**
     * @return int
     */
    public function getNoOfPayments(): int
    {
        return (int) count($this->paymentDates);
    }

    /**
     * @return PaymentScheduleConfigInterface
     */
    public function getConfig(): PaymentScheduleConfigInterface
    {
        return $this->config;
    }

}