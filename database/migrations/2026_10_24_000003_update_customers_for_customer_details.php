<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('customer_type')->default('Individual');
            $table->string('mobile', 30)->nullable();
            $table->string('city', 120)->nullable();
            $table->json('interests')->nullable();
            $table->string('email')->nullable()->change();
        });

        DB::table('customers')->whereNull('mobile')->update([
            'mobile' => DB::raw('contact_number'),
        ]);
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['customer_type', 'mobile', 'city', 'interests']);
        });
    }
};
