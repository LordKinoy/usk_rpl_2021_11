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
        $this->table = 'jurusan';
    } 
    
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->char('id_jurusan')->length(5)->primary();
            $table->tinyInteger('kepala_jurusan')->length(4)->nullable(false);
            $table->string('nama_jurusan')->length(30)->nullable(false);
            $table->string('akronim')->length(5)->nullable(false);

            $table->foreign('kepala_jurusan')->references('id_kaprog')->on('kepala_program')->cascadeOnDelete()->cascadeOnUpdate();

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