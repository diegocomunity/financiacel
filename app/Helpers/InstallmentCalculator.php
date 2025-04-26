<?php

namespace App\Helpers;

class InstallmentCalculator
{
    /**
     * Calcula las cuotas equitativas con interés fijo mensual.
     *
     * @param float $amount
     * @param int $months
     * @param float $rate
     * @return array
     */
    public static function calculate(float $amount, int $months, float $rate = 0.015): array
    {
        $monthlyInterest = $amount * $rate;
        $total = $amount + ($monthlyInterest * $months);
        $instalmentAmount = round($total / $months, 2);

        $instalments = [];
        $startDate = now()->addMonth();

        for ($i = 1; $i <= $months; $i++) {
            $instalments[] = [
                'number' => $i,
                'amount' => $instalmentAmount,
                'due_date' => $startDate->copy()->addMonths($i - 1),
                'paid' => false,
            ];
        }

        return $instalments;
    }
}
