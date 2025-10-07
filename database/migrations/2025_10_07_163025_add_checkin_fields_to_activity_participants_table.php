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
        Schema::table('activity_participants', function (Blueprint $table) {
            $table->boolean('checked_in')->default(false);
            $table->timestamp('checked_in_at')->nullable();
            $table->unsignedBigInteger('checked_in_by')->nullable();
            $table->decimal('actual_hours', 8, 2)->nullable();
            $table->text('checkin_notes')->nullable();

            $table->foreign('checked_in_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_participants', function (Blueprint $table) {
            $table->dropForeign(['checked_in_by']);
            $table->dropColumn([
                'checked_in',
                'checked_in_at',
                'checked_in_by',
                'actual_hours',
                'checkin_notes'
            ]);
        });
    }
};
