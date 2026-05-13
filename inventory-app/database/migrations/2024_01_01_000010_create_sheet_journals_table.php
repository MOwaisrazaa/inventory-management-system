<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sheet_journals', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('debit_party')->nullable();   // Transfer To
            $table->string('credit_party')->nullable();  // Transfer From
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sheet_journals');
    }
};
