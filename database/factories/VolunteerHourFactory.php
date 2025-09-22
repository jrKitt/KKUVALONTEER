<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VolunteerHour>
 */
class VolunteerHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $activities = [
            'กิจกรรมอาสาปลูกข้าวนาเกลื่อน',
            'มือดีกิจกรรมดี เราสร้างความสุข',
            'รองเท้าคู่แรกสร้างชีวิต',
            'ทำความสะอาดสวนสาธารณะ',
            'จัดกิจกรรมให้เด็กกำพร้า',
            'ดูแลผู้สูงอายุ',
            'บริการชุมชน',
            'สอนหนังสือเด็กด้อยโอกาส',
            'ปลูกป่าเพื่อสิ่งแวดล้อม',
            'จัดกิจกรรมรักษ์โลก'
        ];

        return [
            'user_id' => 1,
            'activity_name' => $this->faker->randomElement($activities),
            'description' => $this->faker->paragraph(2),
            'hours' => $this->faker->randomFloat(1, 1, 8),
            'date' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
