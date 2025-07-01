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
        Schema::create('absensi', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal')->nullable();
            $table->string('status')->nullable();
            $table->integer('id_guru')->nullable();
            $table->integer('id_siswa')->nullable();
            $table->integer('id_kelas_siswa')->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0)->nullable();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
