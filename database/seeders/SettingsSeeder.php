<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Faq;
use App\Models\Privacy;
use App\Models\Setting;
use App\Models\Terms;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $defaultLogo = 'uploads/images/logo.png';
        $defaultImage = 'uploads/images/logo.png';

        $settingData = [
            'site_name' => [
                'en' => 'MDO',
                'ar' => 'MDO',
            ],
            'site_title' => [
                'en' => 'MDO Landscape Studio',
                'ar' => 'استوديو MDO لتصميم اللاندسكيب',
            ],
            'site_desc' => [
                'en' => 'A boutique landscape studio shaped around modern restraint and premium execution.',
                'ar' => 'استوديو لاندسكيب بوتيك مبني على البساطة الحديثة والتنفيذ الراقي.',
            ],
            'site_address' => [
                'en' => 'Cairo, Egypt',
                'ar' => 'القاهرة، مصر',
            ],
            'meta_key' => [
                'en' => 'landscape, pool design, outdoor living, luxury landscape, villa garden, MDO',
                'ar' => 'لاندسكيب، مسابح، تصميم خارجي، حدائق فلل، استوديو لاندسكيب، MDO',
            ],
            'meta_desc' => [
                'en' => 'MDO delivers refined landscape design, premium pools, and outdoor environments with a calm modern language.',
                'ar' => 'تقدّم MDO تصميمات لاندسكيب راقية ومساحات خارجية ومسابح بلغة بصرية هادئة وعصرية.',
            ],
            'site_phone' => '+201000000000',
            'site_email' => 'info@mdo-landscape.com',
            'email_support' => 'support@mdo-landscape.com',
            'facebook' => 'https://facebook.com/mdolandscape',
            'x_url' => 'https://x.com/mdolandscape',
            'youtube' => 'https://youtube.com/@mdolandscape',
            'instagram' => 'https://instagram.com/mdolandscape',
            'tiktok' => 'https://tiktok.com/@mdolandscape',
            'linkedin' => 'https://linkedin.com/company/mdolandscape',
            'whatsapp' => '+201000000000',
            'logo' => $defaultLogo,
            'light_logo' => $defaultLogo,
            'dark_logo' => $defaultLogo,
            'favicon' => $defaultLogo,
            'site_copyright' => '© ' . now()->year . ' MDO Landscape Studio. All rights reserved.',
            'promotion_url' => 'https://mdo-landscape.com/contact',
        ];

        Setting::query()->updateOrCreate(['id' => 1], $settingData);

        About::query()->updateOrCreate(
            ['id' => 1],
            [
                'title' => [
                    'en' => 'A landscape studio shaped around modern restraint and premium execution',
                    'ar' => 'استوديو لاندسكيب يتشكّل حول البساطة الحديثة والتنفيذ الراقي',
                ],
                'desc' => [
                    'en' => '<p>This React version keeps the visual calm, monochrome elegance, and premium storytelling expected from a luxury landscape and pool studio.</p><p>Our studio approach is rooted in visual simplicity, smart planning, and outdoor experiences that feel natural to live in.</p>',
                    'ar' => '<p>تعكس هذه النسخة لغة بصرية هادئة وأناقة أحادية راقية وسردًا بصريًا يليق باستوديو لاندسكيب ومسابح فاخر.</p><p>يعتمد أسلوبنا على البساطة المدروسة والتخطيط الذكي وصناعة تجربة خارجية مريحة وطبيعية للعيش.</p>',
                ],
                'image' => $defaultImage,
                'about_badge' => [
                    'en' => 'About the studio',
                    'ar' => 'عن الاستوديو',
                ],
                'about_title' => [
                    'en' => 'A landscape studio shaped around modern restraint and premium execution',
                    'ar' => 'استوديو لاندسكيب يتشكّل حول البساطة الحديثة والتنفيذ الراقي',
                ],
                'about_description' => [
                    'en' => '<p>This React version keeps the visual calm, monochrome elegance, and premium storytelling expected from a luxury landscape and pool studio.</p><p>Our studio approach is rooted in visual simplicity, smart planning, and outdoor experiences that feel natural to live in. Whether a client needs a complete build or a considered renovation, we focus on atmosphere, clarity, and long-term value.</p>',
                    'ar' => '<p>تحافظ هذه النسخة على الهدوء البصري والأناقة الأحادية والسرد الراقي المتوقع من استوديو فاخر لتصميم اللاندسكيب والمسابح.</p><p>يرتكز أسلوبنا على البساطة البصرية والتخطيط الذكي وصناعة مساحات خارجية تشعر بأنها طبيعية للعيش. سواء احتاج العميل إلى تنفيذ كامل أو تطوير مدروس، فنحن نركّز على الأجواء والوضوح والقيمة طويلة المدى.</p>',
                ],
                'about_image' => $defaultImage,
                'mission_badge' => [
                    'en' => 'Our mission',
                    'ar' => 'رسالتنا',
                ],
                'mission_title' => [
                    'en' => 'Elevating the standards of outdoor living',
                    'ar' => 'نرفع معايير الحياة الخارجية',
                ],
                'mission_description' => [
                    'en' => '<p>To provide a seamless design-and-build experience that transforms outdoor environments into high-value architectural statements.</p>',
                    'ar' => '<p>نقدّم تجربة متكاملة للتصميم والتنفيذ تحوّل المساحات الخارجية إلى قيمة معمارية واضحة ومؤثرة.</p>',
                ],
                'mission_image' => $defaultImage,
                'vision_badge' => [
                    'en' => 'Our vision',
                    'ar' => 'رؤيتنا',
                ],
                'vision_title' => [
                    'en' => 'Defining the future of luxury landscape',
                    'ar' => 'نرسم مستقبل اللاندسكيب الفاخر',
                ],
                'vision_description' => [
                    'en' => '<p>To be the most trusted boutique studio for clients seeking modern restraint, technical precision, and an enduring outdoor lifestyle.</p>',
                    'ar' => '<p>أن نكون الاستوديو البوتيكي الأكثر ثقة للعملاء الباحثين عن البساطة الحديثة والدقة الفنية وتجربة خارجية تدوم.</p>',
                ],
                'vision_image' => $defaultImage,
                'shapes_badge' => [
                    'en' => 'What shapes the work',
                    'ar' => 'ما الذي يصنع العمل',
                ],
                'shapes_title' => [
                    'en' => 'Design values that guide every decision',
                    'ar' => 'قيم تصميمية تقود كل قرار',
                ],
                'shapes_description' => [
                    'en' => '<p>We care about elegance, clarity, and a result that still feels good months and years after handover.</p>',
                    'ar' => '<p>نهتم بالأناقة والوضوح والنتيجة التي تظل مريحة ومقنعة بعد التسليم بمدة طويلة.</p>',
                ],
                'shapes_items' => [
                    [
                        'title' => [
                            'en' => 'Elegant clarity',
                            'ar' => 'وضوح أنيق',
                        ],
                        'description' => [
                            'en' => 'Layouts, materials, and planting are selected to create calm confidence rather than visual noise.',
                            'ar' => 'نختار التوزيع والخامات والزراعة لصناعة هدوء ووضوح بدلاً من الضجيج البصري.',
                        ],
                    ],
                    [
                        'title' => [
                            'en' => 'Buildable intelligence',
                            'ar' => 'ذكاء قابل للتنفيذ',
                        ],
                        'description' => [
                            'en' => 'Ideas are developed with execution in mind, so the finished result stays true to the concept.',
                            'ar' => 'نطوّر الأفكار بعين التنفيذ حتى يظل الناتج النهائي وفيًا للفكرة الأصلية.',
                        ],
                    ],
                    [
                        'title' => [
                            'en' => 'Lasting value',
                            'ar' => 'قيمة تدوم',
                        ],
                        'description' => [
                            'en' => 'We design for real life, with practical movement, durable choices, and spaces that age gracefully.',
                            'ar' => 'نصمم للحياة الحقيقية بحركة عملية وخيارات متينة ومساحات تزداد جمالاً مع الوقت.',
                        ],
                    ],
                ],
            ]
        );

        Privacy::query()->updateOrCreate(
            ['id' => 1],
            [
                'title' => ['en' => 'Privacy Policy', 'ar' => 'سياسة الخصوصية'],
                'desc' => [
                    'en' => 'We respect your privacy and only use submitted information to respond to inquiries, manage project communication, and improve the studio experience.',
                    'ar' => 'نحترم خصوصيتك ونستخدم البيانات المُرسلة فقط للرد على الاستفسارات وإدارة التواصل وتحسين تجربة التعامل مع الاستوديو.',
                ],
                'banner' => $defaultImage,
                'image' => $defaultImage,
            ]
        );

        Terms::query()->updateOrCreate(
            ['id' => 1],
            [
                'title' => ['en' => 'Terms & Conditions', 'ar' => 'الشروط والأحكام'],
                'desc' => [
                    'en' => 'By using the MDO website you agree to our terms regarding contact forms, project consultation, intellectual property, and content usage.',
                    'ar' => 'باستخدامك لموقع MDO فإنك توافق على الشروط المتعلقة بطلبات التواصل والاستشارات وحقوق الملكية الفكرية واستخدام المحتوى.',
                ],
                'banner' => $defaultImage,
                'image' => $defaultImage,
            ]
        );

        $faqs = [
            [
                'question' => ['en' => 'Do you handle both design and execution?', 'ar' => 'هل تتولون التصميم والتنفيذ معًا؟'],
                'answer' => ['en' => 'Yes. We can support the full journey from concept design to execution supervision based on project scope.', 'ar' => 'نعم، يمكننا دعم المشروع من مرحلة الفكرة وحتى الإشراف على التنفيذ بحسب نطاق العمل.'],
                'status' => 1,
            ],
            [
                'question' => ['en' => 'Can I request a consultation online?', 'ar' => 'هل يمكنني طلب استشارة أونلاين؟'],
                'answer' => ['en' => 'Absolutely. Use the contact form or WhatsApp button and our team will get back to you.', 'ar' => 'بالتأكيد. استخدم نموذج التواصل أو زر واتساب وسيتواصل معك فريقنا.'],
                'status' => 1,
            ],
            [
                'question' => ['en' => 'Do you work on villas, compounds, and hospitality projects?', 'ar' => 'هل تعملون على الفلل والكمبوندات والمشاريع الفندقية؟'],
                'answer' => ['en' => 'Yes. Our studio can adapt to private residential, shared community, and hospitality outdoor environments.', 'ar' => 'نعم، يعمل الاستوديو على المشاريع السكنية الخاصة والمشاريع المشتركة ومساحات الضيافة الخارجية.'],
                'status' => 1,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->updateOrCreate(['question->en' => $faq['question']['en']], $faq);
        }
    }
}
