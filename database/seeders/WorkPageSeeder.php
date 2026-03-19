<?php

namespace Database\Seeders;

use App\Models\WorkPage;
use Illuminate\Database\Seeder;

class WorkPageSeeder extends Seeder
{
    public function run(): void
    {
        WorkPage::updateOrCreate(['id' => 1], [
            'title' => ['ar' => 'أعمالنا', 'en' => 'Our Work'],
            'eyebrow' => ['ar' => 'المشاريع', 'en' => 'Portfolio'],
            'description' => ['ar' => 'مجموعة مختارة من مشاريعنا المميزة.', 'en' => 'A selection of our premium projects.'],
            'image' => 'uploads/work_page/default.jpg',
        ]);
    }
}
