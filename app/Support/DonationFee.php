<?php

namespace App\Support;


use Exception;

class DonationFee
{

    private int $donation;
    private int $commissionPercentage;
    private const FIXED_FEE = 50;

    public function __construct(int $donation, int $commissionPercentage)
    {
        $this->donation = $this->handleDonation($donation);
        $this->commissionPercentage = $this->handleCommissionPercentage($commissionPercentage);
    }

    public function getCommissionAmount(): int
    {
        return ($this->donation * $this->commissionPercentage)/100;
    }

    public function getAmountCollected(): int
    {
        return $this->donation -$this->getFixedAndCommissionFeeAmount();
    }

    public function getFixedAndCommissionFeeAmount(): int
    {
        $result = $this->getCommissionAmount() + self::FIXED_FEE;
        if ($result > 500){
            return 500;
        }
        return $result;
    }

    public function getSummary(): array
    {
        return [
            'donation'=>$this->donation,
            'commission'=>$this->getCommissionAmount(),
            'fixedFee'=>self::FIXED_FEE,
            'fixedAndCommission'=>$this->getFixedAndCommissionFeeAmount(),
            'amountCollected'=>$this->getAmountCollected()
        ];
    }

    private function handleDonation(int $donation): int
    {
        if ( $donation < 100) {
            throw new Exception("Value should be superior as 100");
        }
        return $donation;
    }

    private function handleCommissionPercentage(int $commissionPercentage): int
    {
        if ($commissionPercentage < 0 || $commissionPercentage > 30) {
            throw  new Exception("Value should be positive and less than 30");
        }
        return $commissionPercentage;
    }
}