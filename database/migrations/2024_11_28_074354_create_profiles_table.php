<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->foreignId('user_id')->unique();
            $table->string('phone_number', 31)->nullable();
            $table->string('address', 60)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('postal_code', 12)->nullable();

            $table->primary(['user_id']);
            $table->index(['user_id']);
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
