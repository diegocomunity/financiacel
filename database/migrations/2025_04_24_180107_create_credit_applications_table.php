<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        Schema::create('credit_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        */
        Schema::create('credit_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('phone_id')->constrained();
            $table->enum('state', ['pending', 'approved', 'rejected'])->default('pending');
            $table->decimal('amount', 10, 2);
            $table->integer('term_months');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_applications');
    }
};
