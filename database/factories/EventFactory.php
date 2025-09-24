<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $events = [
            [
                'title' => 'กิจกรรมอาสาปลูกข้าวนาเกลื่อน ครั้งที่ 1',
                'description' => 'ประสบการณ์การปลูกข้าวแบบดั้งเดิม ณ บ้านดงแสนเขื่อน หมู่ 8 อำเภอน้ำพอง จังหวัดขอนแก่น',
                'location' => 'นาหลังบ้านนายเอกรินทร์',
                'image' => 'carousel_1.jpg',
                'tags' => ['#เกษตรศาสตร์', 'ปี 1-4']
            ],
            [
                'title' => 'มือดีกิจกรรมดี เราสร้างความสุข',
                'description' => 'กิจกรรมสร้างสรรค์เพื่อชุมชน ร่วมกันทำกิจกรรมที่เป็นประโยชน์ต่อสังคม',
                'location' => 'ศูนย์ชุมชนเทศบาลเมือง',
                'image' => 'carousel_2.jpg',
                'tags' => ['#ชุมชน', 'ปี 2-4']
            ],
            [
                'title' => 'รองเท้าคู่แรกสร้างชีวิต',
                'description' => 'โครงการช่วยเหลือเด็กด้อยโอกาส มอบรองเท้าและความรู้แก่น้องๆ',
                'location' => 'โรงเรียนบ้านนาใต้',
                'image' => 'carousel_3.jpg',
                'tags' => ['#การศึกษา', 'ทุกปี']
            ],
            [
                'title' => 'โครงการพัฒนาชุมชนท้องถิ่น',
                'description' => 'ร่วมพัฒนาและปรับปรุงสิ่งแวดล้อมในชุมชน เพื่อคุณภาพชีวิทที่ดีขึ้น',
                'location' => 'ชุมชนบ้านหนองบัว',
                'image' => 'event_1.png',
                'tags' => ['#ชุมชน', '#สิ่งแวดล้อม', 'ปี 1-4']
            ],
            [
                'title' => 'กิจกรรมสร้างสรรค์เยาวชน',
                'description' => 'พัฒนาทักษะและความคิดสร้างสรรค์ให้กับเด็กและเยาวชนในชุมชน',
                'location' => 'ศูนย์เยาวชนอำเภอเมือง',
                'image' => 'family.png',
                'tags' => ['#เยาวชน', '#ทักษะ', 'ปี 2-4']
            ]
        ];

        $event = $this->faker->randomElement($events);

        return [
            'title' => $event['title'],
            'description' => $event['description'],
            'location' => $event['location'],
            'date' => $this->faker->dateTimeBetween('+1 week', '+3 months')->format('j M Y'),
            'hours' => rand(10, 40) . ' ชั่วโมง',
            'image' => $event['image'],
            'tags' => $event['tags'],
            'is_active' => true
        ];
    }
}
