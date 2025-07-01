<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_guru')->nullable();
            $table->unsignedBigInteger('id_kelas_siswa')->nullable();

            $table->date('tanggal')->nullable();
            $table->json('data_siswa')->nullable(); // berisi data kehadiran per siswa
            $table->string('dokumentasi')->nullable(); // path atau nama file dokumentasi

            $table->softDeletes();
            $table->timestamps();

            // Foreign key (optional tapi disarankan)
            $table->foreign('id_guru')->references('id')->on('guru')->onDelete('set null');
            $table->foreign('id_kelas_siswa')->references('id')->on('kelas_siswa')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};

