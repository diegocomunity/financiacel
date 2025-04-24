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
        Schema::create('instalments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        */
        Schema::create('instalments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_application_id')->constrained();
            $table->integer('number'); // cuota número
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->boolean('paid')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instalments');
    }
};
