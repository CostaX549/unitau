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
        Schema::create('tarefa_files', function (Blueprint $table) {
            $table->id();
            $table->string("file");
            $table->unsignedBigInteger("tarefa_id");
            $table->timestamps();
            $table->foreign('tarefa_id')->references('id')->on('tarefas')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefa_files');
    }
};
