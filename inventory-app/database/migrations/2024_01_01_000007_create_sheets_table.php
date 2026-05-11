<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('type', ['sale', 'purchase']);
            $table->string('party_name');
            $table->decimal('total_amount', 12, 2);
            $table->timestamps();
        });

        Schema::create('sheet_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sheet_id')->constrained('sheets')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('rate', 10, 2);
            $table->decimal('amount', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sheet_items');
        Schema::dropIfExists('sheets');
    }
};
