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
        Schema::create('siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('nipd')->nullable();
            $table->string('nisn')->nullable();
            $table->string('gender')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->integer('tanggal_lahir')->nullable();
            $table->integer('nik')->nullable();
            $table->string('agama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('jenis_tinggal')->nullable();
            $table->string('alat_transportasi')->nullable();
            $table->integer('no_hp')->nullable();
            $table->string('kebutuhan_khusus')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->integer('jarak_rumah')->nullable();
            $table->integer('penerima_kps')->nullable();
            $table->integer('no_kps')->nullable();
            $table->integer('penerima_kip')->nullable();
            $table->integer('no_kip')->nullable();
            $table->string('nama_kip')->nullable();
            $table->integer('no_kks')->nullable();
            $table->integer('layak_kip')->nullable();
            $table->string('alasan_layak')->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0)->nullable();
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
