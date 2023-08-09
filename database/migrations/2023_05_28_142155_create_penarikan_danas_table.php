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
        Schema::create('penarikan_danas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penggalangan');
            $table->integer('jumlah')->default(0);
            $table->string('nama');
            $table->string('nama_bank');
            $table->string('no_rekening');
            $table->string('bukti_transfer')->nullable();
            $table->integer('status')->default(0);
            $table->text('catatan_status')->default('');
            $table->timestamps();
        });

        Schema::table('penarikan_danas', function (Blueprint $table) {
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
        Schema::dropIfExists('penarikan_danas');
    }
};
