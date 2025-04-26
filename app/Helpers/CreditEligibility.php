<?php

namespace App\Helpers;

use App\Models\CreditApplication;



class CreditEligibility
{
    /**
     * Verifica si el cliente tiene un crédito activo.
     */
    public static function hasActiveCredit(int $clientId): bool
    {
        return CreditApplication::where('client_id', $clientId)
                                ->whereIn('state', ['pending', 'approved'])
                                ->exists();
    }
}
