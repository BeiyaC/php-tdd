<?php

namespace Tests\Unit;

use App\Support\DonationFee;
use Exception;
use PHPUnit\Framework\TestCase;

class DonationFeeTest extends TestCase
{

    public function test_commission_amount_is_10_cent_form_donation_of_100_cents_and_commission_of_10_percent()
    {
        // Etant donné une donation de 100 et commission de 10%
        $donationFees = new DonationFee(100, 10);

        // Lorsque qu'on appel la méthode getCommissionAmount()
        $actual = $donationFees->getCommissionAmount();

        // Alors la Valeur de la commission doit être de 10
        $expected = 10;
        $this->assertEquals($expected, $actual);
    }

    public function test_commission_amount_is_20_cents_form_donation_of_200_cents_and_commission_of_10_percent()
    {
        // Etant donné une donation de 200 et commission de 10%
        $donationFees = new DonationFee(200, 10);

        // Lorsque qu'on appel la méthode getCommissionAmount()
        $actual = $donationFees->getCommissionAmount();

        // Alors la Valeur de la commission doit être de 20
        $expected = 20;
        $this->assertEquals($expected, $actual);
    }

    public function test_total_amount_collected()
    {
        $ownerAmount = new DonationFee(200, 10);
        $actual = $ownerAmount->getAmountCollected();

        $expected = 130;
        $this->assertEquals($expected, $actual);
    }

    public function test_commission_amount_is_not_between_0_and_30_percent()
    {
        $this->expectException(Exception::class);

        $donationFee = new DonationFee(200, 40);

    }

    public function test_donation_is_not_greater_than_99()
    {
        $this->expectException(Exception::class);

        $donationFee = new DonationFee(50, 10);

    }

    public function test_fixed_fee_and_commission_amount()
    {
        $donationFee = new DonationFee(100, 10);
        $actual = $donationFee->getFixedAndCommissionFeeAmount();

        $expected = 60;
        $this->assertEquals($expected, $actual);
    }

    public function test_total_donation_fee_cannot_be_greater_than_50()
    {
        $donationFee = new DonationFee(6000, 20);
        $actual = $donationFee->getFixedAndCommissionFeeAmount();

        $expected = 500;
        $this->assertEquals($expected, $actual);
    }

    public function test_donation_summary()
    {
        $donationFee = new DonationFee(6000, 20);
        $actual = $donationFee->getSummary();

        $expected = [
            'donation'=>6000,
            'commission'=>1200,
            'fixedFee'=>50,
            'fixedAndCommission'=>500,
            'amountCollected'=>5500
        ];
        $this->assertEquals($expected, $actual);
    }
}
