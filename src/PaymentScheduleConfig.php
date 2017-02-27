<?php

declare(strict_types = 1);

namespace Kauri\Loan;


class PaymentScheduleConfig implements PaymentScheduleConfigInterface
{
    private $noOfPayments;
    private $startDate;
    private $averageIntervalLength = 0;
    private $dateInterval;
    private $firstPaymentDate;

    /**
     * PaymentScheduleConfig constructor.
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
    ) {
        $this->noOfPayments = $noOfPayments;
        $this->startDate = new \DateTime($startDate->format('Y-m-d'), new \DateTimeZone('UTC'));

        if (!is_null($firstPaymentDate)) {
            $this->firstPaymentDate = new \DateTime($firstPaymentDate->format('Y-m-d'), new \DateTimeZone('UTC'));
        }

        $this->dateInterval = new \DateInterval($dateIntervalPattern);

        $this->averageIntervalLength = $this->extractIntervalLength($this->dateInterval);
    }

    /**
     * @param \DateInterval $dateInterval
     * @return int
     */
    private function extractIntervalLength(\DateInterval $dateInterval): int
    {
        $intervalLength = 0;
        $intervalMultiplier = array(
            'd' => 1,
            'm' => 30,
            'y' => 30 * 12
        );

        foreach ($intervalMultiplier as $pattern => $multiplier) {
            if ($dateInterval->format('%' . $pattern) > 0) {
                $intervalLength = $intervalLength + (int) $dateInterval->format('%' . $pattern) * $multiplier;
            }
        }

        return (int) $intervalLength;
    }

    /**
     * @return int
     */
    public function getNoOfPayments(): int
    {
        return $this->noOfPayments;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getStartDate(): \DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @return int
     */
    public function getAverageIntervalLength(): int
    {
        return $this->averageIntervalLength;
    }

    /**
     * @return \DateInterval
     */
    public function getDateInterval(): \DateInterval
    {
        return $this->dateInterval;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getFirstPaymentDate(): ?\DateTimeInterface
    {
        return $this->firstPaymentDate;
    }
}