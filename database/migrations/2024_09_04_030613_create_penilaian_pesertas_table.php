<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianPesertasTable extends Migration
{
    public function up()
    {
        Schema::create('penilaian_pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihan_id')->constrained('pelatihans')->onDelete('cascade');
            $table->string('bulan_penilaian');
            $table->string('tahun_penilaian');
            $table->string('tanggal_penilaian');
            $table->foreignId('pengajar_id')->constrained('pengajars')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian_pesertas');
    }
}
