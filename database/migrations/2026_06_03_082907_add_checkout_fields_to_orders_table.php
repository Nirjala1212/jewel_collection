<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('email')->nullable()->after('user_id');
            $table->string('full_name')->nullable()->after('email');
            $table->string('phone')->nullable()->after('full_name');
            $table->string('province')->nullable()->after('phone');
            $table->string('city')->nullable()->after('province');
            $table->string('area')->nullable()->after('city');
            $table->string('landmark')->nullable()->after('area');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'email',
                'full_name',
                'phone',
                'province',
                'city',
                'area',
                'landmark',
            ]);
        });
    }
};