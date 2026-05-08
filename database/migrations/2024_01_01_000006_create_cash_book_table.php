<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_book', function (Blueprint $table) {
            $table->id();
            $table->date('transaction_date');
            $table->enum('type', ['receipt', 'payment']);
            $table->string('from_to')->nullable();
            $table->string('description');
            $table->decimal('amount', 12, 2);
            $table->string('status')->default('completed');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_book');
    }
};
