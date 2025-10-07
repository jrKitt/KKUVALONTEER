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
        Schema::create('volunteer_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('goal_type')->default('personal'); // personal, faculty, year_based, custom
            $table->decimal('target_hours', 8, 2); // เป้าหมายชั่วโมง
            $table->decimal('current_hours', 8, 2)->default(0); // ชั่วโมงปัจจุบัน
            $table->string('period_type')->default('academic_year'); // academic_year, semester, monthly, custom
            $table->date('start_date'); // วันที่เริ่มต้น
            $table->date('end_date'); // วันที่สิ้นสุด
            $table->string('category')->nullable(); // ประเภทกิจกรรม (academic, social_service, sports, etc.)
            $table->text('description')->nullable(); // คำอธิบายเป้าหมาย
            $table->boolean('is_active')->default(true); // สถานะใช้งาน
            $table->boolean('is_achieved')->default(false); // บรรลุเป้าหมายหรือไม่
            $table->timestamp('achieved_at')->nullable(); // วันที่บรรลุเป้าหมาย
            $table->json('milestone_settings')->nullable(); // การตั้งค่า milestone
            $table->timestamps();

            // Index สำหรับการค้นหา
            $table->index(['user_id', 'is_active']);
            $table->index(['goal_type', 'period_type']);
            $table->index(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_goals');
    }
};
