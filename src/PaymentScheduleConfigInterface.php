<?php

declare(strict_types = 1);

namespace Kauri\Loan;


interface PaymentScheduleConfigInterface
{
    /**
     * PaymentScheduleConfigInterface constructor.
     * @param int $noOfPayments
     * @param \DateTimeInterface $startDate
     * @param string $dateIntervalPattern
     * @param \DateTimeInterface|null $firstPaymentDate
     */
    public function __construct(
        int $noOfPayments,
        \DateTimeInterface $startDate,
        string $dateIntervalPattern,
        \DateTimeInterface $firstPaymentDate = null
    );

    /**
     * @return int
     */
    public function getNoOfPayments(): int;

    /**
     * @return \DateTimeInterface
     */
    public function getStartDate(): \DateTimeInterface;

    /**
     * @return int
     */
    public function getAverageIntervalLength(): int;

    /**
     * @return \DateInterval
     */
    public function getDateInterval(): \DateInterval;

    /**
     * @return \DateTimeInterface|null
     */
    public function getFirstPaymentDate(): ?\DateTimeInterface;
}