<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instalment extends Model
{
    protected $fillable = ['credit_application_id', 'number', 'amount', 'due_date', 'paid'];

    //
    public function creditApplication(){
    
        return $this->belongsTo(CreditApplication::class);
    }

}
