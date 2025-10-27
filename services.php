<?php
$page_title = 'خدماتنا';
include 'header.php';
?>

<!-- Page Header -->
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dark via-dark-lighter to-dark">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
            <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-accent-gold rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: 1s;"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-12">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
            <span class="gradient-text">خدماتنا</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto">
            حلول تسويقية متكاملة مدعومة بأحدث التقنيات لتحقيق أهدافك
        </p>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php
        $services = [
            [
                'id' => 'design',
                'icon' => '<path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                'title' => 'التصميم الجرافيكي',
                'description' => 'نقدم تصاميم إبداعية احترافية تعكس هوية علامتك التجارية وتجذب انتباه جمهورك المستهدف',
                'features' => [
                    'تصميم الهوية البصرية الكاملة',
                    'تصميم المطبوعات والإعلانات',
                    'تصميم البروشورات والكتالوجات',
                    'تصميم الشعارات والأيقونات',
                    'موشن جرافيك وتصاميم متحركة',
                    'تصميم السوشيال ميديا'
                ]
            ],
            [
                'id' => 'social',
                'icon' => '<path d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>',
                'title' => 'إدارة السوشيال ميديا',
                'description' => 'نبني حضوراً قوياً لعلامتك التجارية على منصات التواصل الاجتماعي ونتفاعل مع جمهورك بفعالية',
                'features' => [
                    'إنشاء وإدارة الحسابات',
                    'إنشاء محتوى إبداعي جذاب',
                    'جدولة ونشر المنشورات',
                    'التفاعل مع الجمهور والرد على التعليقات',
                    'تحليل الأداء وإعداد التقارير',
                    'إدارة الإعلانات المدفوعة'
                ]
            ],
            [
                'id' => 'marketing',
                'icon' => '<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
                'title' => 'التسويق الرقمي',
                'description' => 'استراتيجيات تسويقية متكاملة مدعومة بالبيانات والذكاء الاصطناعي لتحقيق أفضل النتائج',
                'features' => [
                    'إعلانات Google وFacebook',
                    'تحسين محركات البحث (SEO)',
                    'التسويق بالمحتوى',
                    'التسويق عبر البريد الإلكتروني',
                    'التسويق بالعمولة',
                    'تحليل البيانات وإعداد التقارير'
                ]
            ],
            [
                'id' => 'video',
                'icon' => '<path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>',
                'title' => 'إنتاج الفيديو',
                'description' => 'نصنع فيديوهات احترافية تحكي قصة علامتك التجارية بطريقة مبتكرة ومؤثرة',
                'features' => [
                    'فيديوهات ترويجية وإعلانية',
                    'موشن جرافيك احترافي',
                    'فيديوهات توضيحية (Explainer Videos)',
                    'إنتاج محتوى للسوشيال ميديا',
                    'تصوير وإنتاج الأحداث',
                    'مونتاج وإخراج احترافي'
                ]
            ],
            [
                'id' => 'web',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>',
                'title' => 'تطوير المواقع والتطبيقات',
                'description' => 'نطور مواقع وتطبيقات عصرية وسريعة ومحسّنة للأداء تلبي احتياجات عملك',
                'features' => [
                    'مواقع الشركات والمؤسسات',
                    'المتاجر الإلكترونية',
                    'تطبيقات الويب التفاعلية',
                    'تطبيقات الموبايل (iOS & Android)',
                    'تحسين الأداء والسرعة',
                    'الصيانة والدعم الفني'
                ]
            ],
            [
                'id' => 'ai',
                'icon' => '<path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
                'title' => 'حلول الذكاء الاصطناعي',
                'description' => 'نستخدم أحدث تقنيات الذكاء الاصطناعي لتحسين أداء حملاتك التسويقية وزيادة فعاليتها',
                'features' => [
                    'تحليل البيانات الذكي',
                    'إنشاء محتوى تلقائي',
                    'استهداف دقيق للجمهور',
                    'تحسين تلقائي للحملات',
                    'روبوتات الدردشة الذكية',
                    'تحليل المشاعر والسلوك'
                ]
            ],
        ];

        foreach ($services as $index => $service): ?>
            <div id="<?php echo $service['id']; ?>" class="mb-24 <?php echo $index % 2 === 0 ? '' : 'bg-dark-lighter -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-16 rounded-2xl'; ?>">
                <div class="grid md:grid-cols-2 gap-12 items-center max-w-7xl mx-auto">
                    <div class="<?php echo $index % 2 === 0 ? '' : 'md:order-2'; ?>">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 text-primary mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <?php echo $service['icon']; ?>
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo $service['title']; ?></h2>
                        <p class="text-lg text-gray-300 mb-6"><?php echo $service['description']; ?></p>
                        <a href="<?php echo url('contact.php'); ?>" class="inline-flex items-center gap-2 text-primary hover:gap-3 transition-all duration-300">
                            <span>احصل على عرض سعر</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                    <div class="<?php echo $index % 2 === 0 ? '' : 'md:order-1'; ?>">
                        <div class="bg-dark-lighter rounded-xl p-8 border border-dark-light">
                            <h3 class="text-xl font-bold mb-6">ما نقدمه:</h3>
                            <ul class="space-y-4">
                                <?php foreach ($service['features'] as $feature): ?>
                                    <li class="flex items-start gap-3">
                                        <svg class="w-6 h-6 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-gray-300"><?php echo $feature; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-24 bg-dark-lighter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            جاهز لبدء مشروعك؟
        </h2>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            احصل على استشارة مجانية وعرض سعر مخصص لمشروعك
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo url('contact.php'); ?>" class="px-8 py-4 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2">
                <span>تواصل معنا الآن</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
            <a href="<?php echo url('portfolio.php'); ?>" class="px-8 py-4 bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-lg font-semibold transition-all duration-300 inline-flex items-center gap-2">
                <span>شاهد أعمالنا</span>
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
