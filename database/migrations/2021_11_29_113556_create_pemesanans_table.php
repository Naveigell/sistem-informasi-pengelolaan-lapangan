<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lapangan_id')->constrained('lapangans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('pembayaran_id')->constrained('pembayarans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_sewa');
            $table->enum('jenis_sewa', ['event', 'reguler']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->unsignedInteger('total_harga');
            $table->unsignedInteger('total_sesi')->nullable();
            $table->enum('status', ['open', 'cancel', 'paid']);
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
        Schema::dropIfExists('pemesanans');
    }
}
