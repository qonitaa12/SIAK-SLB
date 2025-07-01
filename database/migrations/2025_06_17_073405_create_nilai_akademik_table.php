<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_akademik', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel kelas_siswa dan guru_mapel (yang menyimpan guru, mapel, semester, kelas)
            $table->unsignedBigInteger('id_kelas_siswa');
            $table->unsignedBigInteger('id_guru_mapel');

            // Penilaian disimpan dalam bentuk JSON array per jenis asesmen
            $table->json('formatif')->nullable();
            $table->json('sumatif_cp')->nullable();
            $table->json('sumatif_semester')->nullable();
            $table->json('tingkat_akhir')->nullable();

            // Bobot per jenis asesmen
            $table->float('bobot_formatif')->nullable();
            $table->float('bobot_sumatif_cp')->nullable();
            $table->float('bobot_sumatif_semester')->nullable();
            $table->float('bobot_tingkat_akhir')->nullable();

            // Rata-rata nilai tiap jenis
            $table->float('rata_formatif')->nullable();
            $table->float('rata_sumatif_cp')->nullable();
            $table->float('rata_sumatif_semester')->nullable();
            $table->float('rata_tingkat_akhir')->nullable();

            // Total rata-rata akhir berdasarkan bobot
            $table->float('rata_total')->nullable();

            // Evaluasi keseluruhan
            $table->string('evaluasi')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_akademik');
    }
};
