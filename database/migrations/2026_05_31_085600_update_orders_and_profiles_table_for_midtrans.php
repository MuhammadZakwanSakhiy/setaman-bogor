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
        // 1. Update orders table
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'snap_token')) {
                $table->string('snap_token')->nullable()->after('whatsapp_message');
            }
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method', 50)->default('Midtrans')->after('whatsapp_message');
            }
            
            // Mengubah tipe kolom status menjadi string agar fleksibel dan tidak bentrok dengan enum lama
            $table->string('status', 30)->default('menunggu')->change();
        });

        // 2. Update user_profiles table
        Schema::table('user_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('user_profiles', 'province')) {
                $table->string('province')->nullable()->after('address');
            }
            if (!Schema::hasColumn('user_profiles', 'city')) {
                $table->string('city')->nullable()->after('province');
            }
            if (!Schema::hasColumn('user_profiles', 'subdistrict')) {
                $table->string('subdistrict')->nullable()->after('city');
            }
            if (!Schema::hasColumn('user_profiles', 'village')) {
                $table->string('village')->nullable()->after('subdistrict');
            }
            if (!Schema::hasColumn('user_profiles', 'postal_code')) {
                $table->string('postal_code', 10)->nullable()->after('village');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'snap_token')) {
                $table->dropColumn('snap_token');
            }
            if (Schema::hasColumn('orders', 'payment_method')) {
                $table->dropColumn('payment_method');
            }
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $columns = ['province', 'city', 'subdistrict', 'village', 'postal_code'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('user_profiles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
