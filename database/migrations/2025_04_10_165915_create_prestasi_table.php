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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lomba')->nullable();
            $table->integer('tingkat')->nullable();
            $table->integer('juara')->nullable();
            $table->integer('tanggal')->nullable();
            $table->integer('Dokumentasi')->nullable();
            $table->integer('id_siswa')->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0)->nullable();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
