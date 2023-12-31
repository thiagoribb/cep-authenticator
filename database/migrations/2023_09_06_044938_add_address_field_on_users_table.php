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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cep')->nullable()->nullable();
            $table->string('street')->nullable();
            $table->string('neighbourhood')->nullable();
            $table->string('city')->nullable();
            $table->string('uf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cep');
            $table->dropColumn('street');
            $table->dropColumn('neighbourhood');
            $table->string('city');
            $table->string('uf');
        });
    }
};
