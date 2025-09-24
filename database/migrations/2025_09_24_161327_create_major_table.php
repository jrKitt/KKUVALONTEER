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
        Schema::create('major', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("facility_id");
            $table->string("short_name");
            $table->string("name_th");
            $table->string("name_en");

            $table->foreign('facility_id')->references('id')->on('facilities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('major');
    }
};
