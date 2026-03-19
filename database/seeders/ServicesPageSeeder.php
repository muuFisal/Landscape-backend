<?php

namespace Database\Seeders;

use App\Models\ServicesPage;
use Illuminate\Database\Seeder;

class ServicesPageSeeder extends Seeder
{
    public function run(): void
    {
        ServicesPage::updateOrCreate(['id' => 1], [
            'title' => ['ar' => 'خدماتنا', 'en' => 'Our Services'],
            'description' => ['ar' => 'نحن نقدم مجموعة شاملة من خدمات تصميم وتنفيذ الحدائق.', 'en' => 'We provide a comprehensive range of landscape design and implementation services.'],
            'image' => 'uploads/services_page/default.jpg',
        ]);
    }
}
