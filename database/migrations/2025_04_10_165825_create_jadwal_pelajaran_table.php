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
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hari')->nullable();
            $table->integer('jam_mulai')->nullable();
            $table->integer('jam_selesai')->nullable();
            $table->integer('id_kelas')->nullable();
            $table->integer('id_mapel')->nullable();
            $table->integer('id_guru')->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0)->nullable();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajaran');
    }
};
