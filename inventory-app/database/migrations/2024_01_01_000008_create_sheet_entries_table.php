<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Purchase entries for daily sheet
        Schema::create('sheet_purchases', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('set null');
            $table->foreignId('item_id')->nullable()->constrained('items')->onDelete('set null');
            $table->integer('quantity')->default(0);
            $table->decimal('rate', 10, 2)->default(0);
            $table->decimal('amount', 12, 2)->default(0);
            $table->timestamps();
        });

        // Sale entries for daily sheet
        Schema::create('sheet_sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('item_id')->nullable()->constrained('items')->onDelete('set null');
            $table->integer('quantity')->default(0);
            $table->decimal('rate', 10, 2)->default(0);
            $table->decimal('amount', 12, 2)->default(0);
            $table->timestamps();
        });

        // Receipt entries for daily sheet cash book
        Schema::create('sheet_receipts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('from_party')->nullable();
            $table->string('status')->default('received');
            $table->decimal('amount', 12, 2)->default(0);
            $table->timestamps();
        });

        // Payment entries for daily sheet cash book
        Schema::create('sheet_payments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('to_party')->nullable();
            $table->string('status')->default('paid');
            $table->decimal('amount', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sheet_payments');
        Schema::dropIfExists('sheet_receipts');
        Schema::dropIfExists('sheet_sales');
        Schema::dropIfExists('sheet_purchases');
    }
};
