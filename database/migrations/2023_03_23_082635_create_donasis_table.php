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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penggalangan');
            $table->string('nama');
            $table->string('email');
            $table->integer('jumlah')->default(0);
            $table->enum('metode_pembayaran',['qris','bsi'])->default('qris');
            $table->string('bukti_pembayaran');
            $table->boolean('kirim_email')->default(false);
            $table->integer('verif')->default(0);
            $table->text('catatan_verif')->default('');
            $table->timestamps();
        });

        Schema::table('donasis', function (Blueprint $table) {
            $table->foreign('id_penggalangan')->references('id')->on('penggalangans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donasis');
    }
};
