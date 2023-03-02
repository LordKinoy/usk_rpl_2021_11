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
    protected $table;
    public function __construct()
    {
        $this->table = 'kelas';
    } 
    
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->tinyInteger('id_kelas')->length(4)->autoIncrement();
            $table->tinyInteger('id_walas')->length(4)->nullable(false);
            $table->char('id_jurusan')->length(5)->nullable(false);
            $table->tinyInteger('id_angkatan')->length(4)->nullable(false);
            $table->string('nama_kelas')->length(5)->nullable(false);
            $table->string('tingkat_kelas')->length(5)->nullable(false);

            $table->foreign('id_walas')->references('id_walas')->on('wali_kelas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_angkatan')->references('id_angkatan')->on('angkatan')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
};