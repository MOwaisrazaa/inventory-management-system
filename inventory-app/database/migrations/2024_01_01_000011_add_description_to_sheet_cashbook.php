<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sheet_receipts', function (Blueprint $table) {
            $table->string('description')->nullable()->after('status');
        });

        Schema::table('sheet_payments', function (Blueprint $table) {
            $table->string('description')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('sheet_receipts', function (Blueprint $table) {
            $table->dropColumn('description');
        });
        Schema::table('sheet_payments', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
