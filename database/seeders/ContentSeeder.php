<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\WhyChooseSection;
use App\Models\WhyChooseSectionItem;
use App\Models\RequestServiceSection;
use App\Models\GalleryPage;
use App\Models\Gallery;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Why Choose Section
        $whyChoose = WhyChooseSection::updateOrCreate(['id' => 1], [
            'title' => [
                'ar' => 'لماذا تختار MDO؟',
                'en' => 'Why Choose MDO?',
            ],
            'description' => [
                'ar' => 'نحن نقدم أفضل حلول التصميم الخارجي والحدائق مع التركيز على الجودة والابتكار.',
                'en' => 'We provide the best outdoor and landscape design solutions with a focus on quality and innovation.',
            ],
            'image' => 'uploads/settings/why-choose/default.webp',
            'status' => 1,
        ]);

        $items = [
            [
                'title' => ['ar' => 'تصاميم مبتكرة', 'en' => 'Innovative Designs'],
                'description' => ['ar' => 'نحول رؤيتك إلى واقع مبهر من خلال التصميمات الإبداعية.', 'en' => 'Transforming your vision into reality through creative designs.'],
                'sort_order' => 1,
            ],
            [
                'title' => ['ar' => 'فريق خبير', 'en' => 'Expert Team'],
                'description' => ['ar' => 'نخبة من المهندسين والمصممين ذوي الخبرة الواسعة.', 'en' => 'A team of highly experienced engineers and designers.'],
                'sort_order' => 2,
            ],
            [
                'title' => ['ar' => 'جودة لا تضاهى', 'en' => 'Unmatched Quality'],
                'description' => ['ar' => 'نلتزم بأعلى معايير الجودة في كل تفاصيل العمل.', 'en' => 'Committed to the highest quality standards in every detail.'],
                'sort_order' => 3,
            ],
        ];

        foreach ($items as $item) {
            WhyChooseSectionItem::updateOrCreate(
                ['why_choose_section_id' => $whyChoose->id, 'title->en' => $item['title']['en']],
                $item
            );
        }

        // 2. Request Service Section
        RequestServiceSection::updateOrCreate(['id' => 1], [
            'small_label' => ['ar' => 'هل أنت مستعد للبدء؟', 'en' => 'Ready to Start?'],
            'title' => ['ar' => 'اطلب خدماتنا الآن', 'en' => 'Request Our Services Now'],
            'description' => ['ar' => 'دعنا نساعدك في تصميم مساحتك الخارجية المثالية.', 'en' => 'Let us help you design your perfect outdoor space.'],
            'button_text' => ['ar' => 'تواصل معنا', 'en' => 'Contact Us'],
            'image' => 'uploads/settings/request-service/default.webp',
            'status' => 1,
        ]);

        // 3. Gallery Page Details
        GalleryPage::updateOrCreate(['id' => 1], [
            'title' => ['ar' => 'معرض أعمالنا', 'en' => 'Our Gallery'],
            'description' => ['ar' => 'استعرض مجمُوعة مختارة من مشاريعنا المميزة.', 'en' => 'Explore a curated collection of our distinguished projects.'],
            'image' => 'uploads/gallery/default_hero.webp',
        ]);

        // 4. Gallery Items
        $galleries = [
            ['title' => ['ar' => 'فيلا مودرن - الرياض', 'en' => 'Modern Villa - Riyadh'], 'sort_order' => 1],
            ['title' => ['ar' => 'تنسيق حدائق قصر', 'en' => 'Palace Landscaping'], 'sort_order' => 2],
            ['title' => ['ar' => 'مساحة خارجية تجارية', 'en' => 'Commercial Outdoor Space'], 'sort_order' => 3],
        ];

        foreach ($galleries as $gallery) {
            Gallery::updateOrCreate(
                ['title->en' => $gallery['title']['en']],
                array_merge($gallery, ['image' => 'uploads/gallery/items/default.webp', 'status' => 1])
            );
        }

        // 5. Banners
        $banners = [
            [
                'title' => [
                    'ar' => 'تصميم خارجي راقٍ يتجاوز التوقعات',
                    'en' => 'Elevated Outdoor Design Beyond Expectations',
                ],
                'primary_label' => [
                    'ar' => 'استثنائي',
                    'en' => 'Exceptional',
                ],
                'secondary_label' => [
                    'ar' => 'تصاميمنا',
                    'en' => 'Our Designs',
                ],
                'sub_labels' => [
                    ['ar' => 'جودة معمارية', 'en' => 'Architectural Quality'],
                    ['ar' => 'بساطة حديثة', 'en' => 'Modern Restraint'],
                    ['ar' => 'تنفيذ فاخر', 'en' => 'Premium Execution'],
                ],
                'banner' => 'uploads/settings/banners/banner1.webp',
                'sort_order' => 1,
                'status' => 1,
            ],
            [
                'title' => [
                    'ar' => 'مساحات خارجية هادئة بلمسة عصرية',
                    'en' => 'Calm Outdoor Spaces with a Modern Touch',
                ],
                'primary_label' => [
                    'ar' => 'بساطة',
                    'en' => 'Simplicity',
                ],
                'secondary_label' => [
                    'ar' => 'معرض الأعمال',
                    'en' => 'Gallery',
                ],
                'sub_labels' => [
                    ['ar' => 'توازن بصري', 'en' => 'Visual Balance'],
                    ['ar' => 'مواد مستدامة', 'en' => 'Sustainable Materials'],
                ],
                'banner' => 'uploads/settings/banners/banner2.webp',
                'sort_order' => 2,
                'status' => 1,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['title->en' => $banner['title']['en']],
                $banner
            );
        }
    }
}
