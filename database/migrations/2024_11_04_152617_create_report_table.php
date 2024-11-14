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
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('nama_lengkap');
            $table->text('kondisi_sarpras');
            $table->integer('jumlah_hunian');
            $table->integer('qrdata_id');
            $table->text('keterangan');
            $table->enum('status', ['NOT_SUBMITTED', 'SUBMITTED'])->default('NOT_SUBMITTED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
