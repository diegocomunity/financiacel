<?php

namespace Tests\Unit;

use App\Helpers\InstallmentCalculator;
use PHPUnit\Framework\TestCase;

/*
class InstallmentCalculatorTest extends TestCase
{
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

}
*/

//use App\Helpers\InstallmentCalculator;
//use Tests\TestCase;

class InstallmentCalculatorTest extends TestCase
{
    public function test_calculate_instalments_returns_correct_number_of_months()
    {
        $amount = 1200000; // 1.2 millones
        $months = 6;
        $rate = 0.015;

        $result = InstallmentCalculator::calculate($amount, $months, $rate);

        $this->assertCount(6, $result);

        foreach ($result as $i => $instalment) {
            $this->assertEquals($i + 1, $instalment['number']);
            $this->assertIsFloat($instalment['amount']);
            $this->assertArrayHasKey('due_date', $instalment);
            $this->assertFalse($instalment['paid']);
        }
    }
}

