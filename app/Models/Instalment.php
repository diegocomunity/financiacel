<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalment extends Model
{
    use HasFactory;
    protected $fillable = ['credit_application_id', 'number', 'amount', 'due_date', 'paid'];

    //
    /*
    protected $casts = [
        'due_date' => 'date',
        'paid' => 'boolean',
    ];
    */
    public function creditApplication(){
    
        return $this->belongsTo(CreditApplication::class);
    }

}
