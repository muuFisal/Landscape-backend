<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => ['ar' => 'تصميم وتنسيق الحدائق', 'en' => 'Landscape Design'],
                'description' => ['ar' => 'تحويل المساحات الخارجية إلى واحات فنية.', 'en' => 'Transforming outdoor spaces into artistic oases.'],
                'slug' => 'landscape-design',
                'image' => 'uploads/services/service1.jpg',
                'has_projects' => true,
                'show_in_projects_filter' => true,
                'sort_order' => 1,
                'status' => 1,
            ],
            [
                'title' => ['ar' => 'نوافير وحمامات سباحة', 'en' => 'Fountains & Pools'],
                'description' => ['ar' => 'تصميم وبناء أحدث أنظمة مائية.', 'en' => 'Design and construction of state-of-the-art water systems.'],
                'slug' => 'pools-fountains',
                'image' => 'uploads/services/service2.jpg',
                'has_projects' => true,
                'show_in_projects_filter' => true,
                'sort_order' => 2,
                'status' => 1,
            ],
            [
                'title' => ['ar' => 'أنظمة الري الآلي', 'en' => 'Automatic Irrigation'],
                'description' => ['ar' => 'حلول ذكية لري مستدام وموفر للمياه.', 'en' => 'Smart solutions for sustainable and water-saving irrigation.'],
                'slug' => 'irrigation-systems',
                'image' => 'uploads/services/service3.jpg',
                'has_projects' => false,
                'show_in_projects_filter' => false,
                'sort_order' => 3,
                'status' => 1,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
