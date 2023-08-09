<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggalangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_panti');
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('foto');
            $table->integer('jumlah');
            $table->date('waktu_mulai');
            $table->date('waktu_selesai');
            $table->string('proposal');
            $table->string('bukti_pencairan_dana')->nullable();
            $table->string('laporan')->nullable();
            $table->boolean('status')->default(false);
            $table->integer('verif')->default(0);
            $table->integer('verif_laporan')->default(0);
            $table->text('catatan_verif')->default('');
            $table->text('catatan_status')->default('');
            $table->text('catatan_laporan')->default('');
            $table->timestamps();
        });

        Schema::table('penggalangans', function (Blueprint $table) {
            $table->foreign('id_panti')->references('id')->on('pantis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggalangans');
    }
};
