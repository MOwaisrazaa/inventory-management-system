<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Replace vendor_id (foreign key) with vendor_name (text)
        Schema::table('sheet_purchases', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn('vendor_id');
            $table->string('vendor_name')->nullable()->after('date');
        });

        // Replace customer_id (foreign key) with customer_name (text)
        Schema::table('sheet_sales', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
            $table->string('customer_name')->nullable()->after('date');
        });
    }

    public function down(): void
    {
        Schema::table('sheet_purchases', function (Blueprint $table) {
            $table->dropColumn('vendor_name');
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('set null');
        });

        Schema::table('sheet_sales', function (Blueprint $table) {
            $table->dropColumn('customer_name');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
        });
    }
};
