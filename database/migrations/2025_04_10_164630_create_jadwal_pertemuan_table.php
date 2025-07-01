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
        Schema::create('jadwal_pertemuan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tanggal')->nullable();
            $table->integer('waktu')->nullable();
            $table->string('tempat')->nullable();
            $table->string('status')->nullable();
            $table->integer('id_orangtua')->nullable();
            $table->integer('id_guru')->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pertemuan');
    }
};
