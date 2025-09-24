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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string("name_th");
            $table->string("name_en");
            $table->enum('status', ['pending', 'ongoing', 'finished']);
            $table->text('description');
            $table->text('detail'); //string[] pls bro
            $table->string('location'); 
            $table->timestamp('start_time')->nullable(); 
            $table->timestamp('end_time')->nullable(); 
            $table->integer('accept_amount'); 
            $table->integer('create_by'); 
            $table->integer('type_id'); 
            $table->string('image_file_name')->nullable(); 
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
