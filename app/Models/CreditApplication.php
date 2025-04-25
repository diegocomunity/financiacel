<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditApplication extends Model
{
    protected $fillable = ['client_id', 'phone_id', 'state', 'amount', 'term_months'];



    public function client(){

        return $this->belongsTo(Client::class);
    }

    public function phone(){

        return $this->belongsTo(Phone::class);
    }

    public function instalments(){
        
        return $this->hasMany(Instalment::class);
    }


    //
}
