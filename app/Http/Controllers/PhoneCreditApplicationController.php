<?php

namespace App\Http\Controllers;

use App\Helpers\CreditEligibility;
use App\Helpers\InstallmentCalculator;
use App\Models\CreditApplication;
use App\Models\Instalment;
use App\Models\Phone;
use DB;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class PhoneCreditApplicationController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'phone_id' => 'required|exists:phones,id',
            'term_months' => 'required|integer|min:1|max:36',
        ]);

        $clientId = $request->client_id;
        $phoneId = $request->phone_id;
        $months = $request->term_months;

        /*
        $hasActive = CreditApplication::where('client_id', $clientId)
                                        ->whereIn('state', ['pending', 'approved'])
                                        ->exists();
                                        */

        

                                        
        if (CreditEligibility::hasActiveCredit($clientId)) {
            return response()->json([
                'error' => 'El cliente ya tiene un crédito activo.'
            ]);
        }

        // Verificar si hay telefonos en el stock
        $phone = Phone::find($phoneId);

        if ($phone->stock <= 0) {
            return response()->json(['error' => 'No tenemos ese modelo en el stock']);
        }


        $amount = $phone->price;

        //$instalments = $this->calculateInstalments($amount, $months);
        $instalments = InstallmentCalculator::calculate($amount, $months);

        DB::beginTransaction();

        try {
            //guardar aplicación al credito
            $application = CreditApplication::create([
                'client_id' => $clientId,
                'phone_id' => $phoneId,
                'state' => 'approved',
                'amount' => $amount,
                'term_months' => $months,
            ]);
    
            foreach ($instalments as $inst) {
                Instalment::create([
                    'credit_application_id' => $application->id,
                    ...$inst
                ]);
            }
    
            $phone->decrement('stock');
    
            DB::commit();
    
            return response()->json(['message' => 'Crédito aprobado', 'application_id' => $application->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al procesar la solicitud.'], 500);
        }



    }


    public function show($id){

        $credit = CreditApplication::with('client', 'phone')->find($id);

        if (!$credit) {
            return response()->json(['error' => 'Solicitud no encontrada'], 404);
        }

        return response()->json([
            'id' => $credit->id,
            'client' => $credit->client->name,
            'phone' => $credit->phone->model,
            'amount' => $credit->amount,
            'term_months' => $credit->term_months,
            'state' => $credit->state,
            'created_at' => $credit->created_at->toDateTimeString(),
        ]);
    }


 
    //Nùmero de cuotas
    public function instalments($id){
        
        $credit = CreditApplication::find($id);

        if (!$credit) {
            return response()->json(['error' => 'Solicitud no encontrada'], 404);
        }

        $instalments = $credit->instalments()->get(['number', 'amount', 'due_date', 'paid']);

        return response()->json([
            'application_id' => $credit->id,
            'instalments' => $instalments,
        ]);
    }

    //helper 
    private function calculateInstalments($amount, $months, $rate = 0.015)
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
