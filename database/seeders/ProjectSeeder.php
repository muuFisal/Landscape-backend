<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $service1 = Service::where('slug', 'landscape-design')->first();
        $service2 = Service::where('slug', 'pools-fountains')->first();

        if (!$service1 || !$service2) return;

        $projects = [
            [
                'service_id' => $service1->id,
                'title' => ['ar' => 'فيلا الملقا النموذجية', 'en' => 'Al Malqa Model Villa'],
                'slug' => 'al-malqa-villa',
                'short_description' => ['ar' => 'تصميم حديقة عصرية بلمسة طبيعية.', 'en' => 'Modern landscape design with a natural touch.'],
                'year' => '2023',
                'location' => ['ar' => 'الرياض، السعودية', 'en' => 'Riyadh, Saudi Arabia'],
                'area' => ['ar' => '450 م²', 'en' => '450 m²'],
                'challenge_title' => ['ar' => 'التحدي الأصعب', 'en' => 'The Main Challenge'],
                'challenge_description' => ['ar' => 'تحويل مساحة ضيقة ومائلة إلى مساحة جلوس متدرجة.', 'en' => 'Converting a small and sloped space into a tiered seating area.'],
                'solution_title' => ['ar' => 'حلولنا المبتكرة', 'en' => 'Innovative Solution'],
                'solution_description' => ['ar' => 'استخدام الجدران الاستنادية الحجرية وزراعة نباتات متدلية.', 'en' => 'Utilizing stone retaining walls and hanging plants.'],
                'facts' => ['Premium Design', 'Residential', 'Night Lighting'],
                'sort_order' => 1,
                'status' => 1,
            ],
            [
                'service_id' => $service1->id,
                'title' => ['ar' => 'حديقة قصر النرجس', 'en' => 'An Narjis Palace Garden'],
                'slug' => 'narjis-palace',
                'short_description' => ['ar' => 'مشروع فاخر يجمع بين الفخامة والخصوصية.', 'en' => 'Luxury project combining prestige and privacy.'],
                'year' => '2024',
                'location' => ['ar' => 'الرياض، السعودية', 'en' => 'Riyadh, Saudi Arabia'],
                'area' => ['ar' => '1200 م²', 'en' => '1200 m²'],
                'challenge_title' => ['ar' => 'المحافظة على الخصوصية', 'en' => 'Maintaining Privacy'],
                'challenge_description' => ['ar' => 'خلق مساحة معزولة عن المباني المجاورة.', 'en' => 'Creating a space isolated from neighboring buildings.'],
                'solution_title' => ['ar' => 'أشجار الظل الكثيفة', 'en' => 'Dense Shade Trees'],
                'solution_description' => ['ar' => 'غابة مصغرة من أشجار "البونسيانا" و"النيم".', 'en' => 'A mini-forest of Poinciana and Neem trees.'],
                'facts' => ['Private Garden', 'Forest Aesthetic', 'Smart Irrigation'],
                'sort_order' => 2,
                'status' => 1,
            ],
            [
                'service_id' => $service2->id,
                'title' => ['ar' => 'مجمع الياسمين المائي', 'en' => 'Al Yasmin Water Complex'],
                'slug' => 'yasmin-water',
                'short_description' => ['ar' => 'نوافير راقصة ومسبح بمواصفات عالمية.', 'en' => 'Dancing fountains and an international-standard pool.'],
                'year' => '2024',
                'location' => ['ar' => 'جدة، السعودية', 'en' => 'Jeddah, Saudi Arabia'],
                'area' => ['ar' => '300 م²', 'en' => '300 m²'],
                'challenge_title' => ['ar' => 'استدامة المياه', 'en' => 'Water Sustainability'],
                'challenge_description' => ['ar' => 'نظام تنقية مغلق وموفر للطاقة.', 'en' => 'A closed-circuit energy-saving filtration system.'],
                'solution_title' => ['ar' => 'فلاتر طبية حديثة', 'en' => 'Modern Bio-filters'],
                'solution_description' => ['ar' => 'نظام الكتروليز لتقليل استخدام الكيماويات.', 'en' => 'Electrolysis system to reduce chemical usage.'],
                'facts' => ['Water Feature', 'Eco-Friendly', 'Smart Control'],
                'sort_order' => 3,
                'status' => 1,
            ],
        ];

        foreach ($projects as $project) {
            $p = Project::updateOrCreate(['slug' => $project['slug']], $project);
            
            // Add some placeholder images for each project
            ProjectImage::updateOrCreate(['project_id' => $p->id, 'sort_order' => 1], [
                'image' => 'uploads/projects/gallery/p' . $p->id . '_1.jpg',
                'status' => 1
            ]);
            ProjectImage::updateOrCreate(['project_id' => $p->id, 'sort_order' => 2], [
                'image' => 'uploads/projects/gallery/p' . $p->id . '_2.jpg',
                'status' => 1
            ]);
        }
    }
}
