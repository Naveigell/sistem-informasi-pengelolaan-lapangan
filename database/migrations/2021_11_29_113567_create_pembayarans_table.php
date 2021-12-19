<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pemesanan_id')->constrained('pemesanans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_pembayaran');
            $table->unsignedInteger('total_pembayaran');
            $table->string('bukti_transaksi', 100)->nullable();
            $table->enum('bank_tujuan', ['bri', 'bca'])->nullable();
            $table->string('bank_pengirim', 20)->nullable();
            $table->string('nomor_rekening_pengirim', 20)->nullable();
            $table->string('atas_nama_pengirim', 20)->nullable();
            $table->enum('status', ['valid', 'invalid'])->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
