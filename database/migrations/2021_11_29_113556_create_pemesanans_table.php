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
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_sewa');
            $table->enum('jenis_sewa', ['event', 'reguler']);
            $table->unsignedInteger('total_harga');
            $table->enum('status', ['open', 'cancel', 'paid'])->default('open');
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
