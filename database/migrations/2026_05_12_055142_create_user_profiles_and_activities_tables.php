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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->text('avatar_url')->nullable();
            $table->text('bio')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_public')->default(true);
            $table->boolean('email_notifications')->default(true);
            $table->boolean('dark_mode')->default(false);
            $table->timestamps();
        });

        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->text('activity');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
        Schema::dropIfExists('user_profiles');
    }
};
