<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DonationFeeTest extends TestCase
{

    public function test_commission_amount_is_10_cent_form_donation_of_100_cents_and_commission_of_10_percent()
    {
        // Etant donné une donation de 100 et commission de 10%
        $donationFees = new \App\Support\DonationFee(100, 10);

        // Lorsque qu'on appel la méthode getCommissionAmount()
        $actual = $donationFees->getCommissionAmount();

        // Alors la Valeur de la commission doit être de 10
        $expected = 10;
        $this->assertEquals($expected, $actual);
    }

    public function test_commission_amount_is_20_cents_form_donation_of_200_cents_and_commission_of_10_percent()
    {
        // Etant donné une donation de 200 et commission de 10%
        $donationFees = new \App\Support\DonationFee(200, 10);

        // Lorsque qu'on appel la méthode getCommissionAmount()
        $actual = $donationFees->getCommissionlsAmount();

        // Alors la Valeur de la commission doit être de 20
        $expected = 20;
        $this->assertEquals($expected, $actual);
    }
}
