<?php
$page_title = 'دراسات الحالة';
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
            <span class="gradient-text">دراسات الحالة</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto">
            قصص نجاح حقيقية لعملائنا مع نتائج قابلة للقياس
        </p>
    </div>
</section>

<!-- Case Studies -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php
        $case_studies = [
            [
                'client' => 'الأرشيف الوطني - الإمارات',
                'industry' => 'حكومي',
                'challenge' => 'تحديث الهوية البصرية وتصميم منصة رقمية متكاملة لحفظ الوثائق التاريخية',
                'solution' => 'قمنا بتصميم هوية بصرية عصرية تحترم التراث، وبناء منصة رقمية متقدمة مع نظام أرشفة ذكي يدعم البحث المتقدم والذكاء الاصطناعي',
                'results' => [
                    ['metric' => 'زيادة في الزيارات', 'value' => '250%'],
                    ['metric' => 'تحسين تجربة المستخدم', 'value' => '95%'],
                    ['metric' => 'سرعة الوصول للوثائق', 'value' => '80%'],
                    ['metric' => 'رضا المستخدمين', 'value' => '98%']
                ],
                'services' => ['تصميم الهوية البصرية', 'تطوير المنصة الرقمية', 'نظام الأرشفة الذكي', 'UX/UI Design'],
                'duration' => '6 أشهر',
                'image' => 'https://via.placeholder.com/800x600/0b0b0c/d4af37?text=National+Archives'
            ],
            [
                'client' => 'مصرف الإمارات المركزي',
                'industry' => 'مالي - حكومي',
                'challenge' => 'تطوير حملة إعلانية رقمية متكاملة لزيادة الوعي بالخدمات المصرفية الرقمية',
                'solution' => 'أطلقنا حملة متعددة القنوات تشمل Google Ads، Social Media، وفيديوهات توعوية، مع استهداف دقيق للفئات المستهدفة',
                'results' => [
                    ['metric' => 'زيادة التسجيلات', 'value' => '180%'],
                    ['metric' => 'تقليل تكلفة الاكتساب', 'value' => '45%'],
                    ['metric' => 'معدل التفاعل', 'value' => '12.5%'],
                    ['metric' => 'ROI', 'value' => '320%']
                ],
                'services' => ['استراتيجية التسويق الرقمي', 'Google Ads', 'Social Media Marketing', 'إنتاج الفيديو'],
                'duration' => '3 أشهر',
                'image' => 'https://via.placeholder.com/800x600/0b0b0c/d4af37?text=Central+Bank'
            ],
            [
                'client' => 'KFC - الإمارات',
                'industry' => 'مطاعم',
                'challenge' => 'زيادة الطلبات عبر التطبيق وتحسين معدل التحويل',
                'solution' => 'صممنا حملة إعلانية موسمية مع عروض حصرية، وحسّنا تجربة المستخدم في التطبيق، وأطلقنا برنامج ولاء رقمي',
                'results' => [
                    ['metric' => 'زيادة الطلبات', 'value' => '156%'],
                    ['metric' => 'معدل التحويل', 'value' => '89%'],
                    ['metric' => 'عودة العملاء', 'value' => '67%'],
                    ['metric' => 'متوسط قيمة الطلب', 'value' => '+42 AED']
                ],
                'services' => ['تحسين التطبيق', 'حملات إعلانية', 'برنامج الولاء', 'تحليل البيانات'],
                'duration' => '4 أشهر',
                'image' => 'https://via.placeholder.com/800x600/0b0b0c/d4af37?text=KFC'
            ],
            [
                'client' => 'noon - منصة التجارة الإلكترونية',
                'industry' => 'تجارة إلكترونية',
                'challenge' => 'زيادة المبيعات خلال موسم التخفيضات وتحسين معدل التحويل',
                'solution' => 'أطلقنا حملة تسويقية متكاملة مع إعلانات مستهدفة، محتوى جذاب، وعروض محدودة الوقت مع countdown timers',
                'results' => [
                    ['metric' => 'زيادة المبيعات', 'value' => '310%'],
                    ['metric' => 'معدل التحويل', 'value' => '8.9%'],
                    ['metric' => 'عدد الطلبات', 'value' => '+45K'],
                    ['metric' => 'ROAS', 'value' => '4.8x']
                ],
                'services' => ['حملات Google Ads', 'Social Media Ads', 'Email Marketing', 'تحسين معدل التحويل'],
                'duration' => '2 شهر',
                'image' => 'https://via.placeholder.com/800x600/0b0b0c/d4af37?text=noon'
            ],
            [
                'client' => 'DAMAC Properties',
                'industry' => 'عقارات',
                'challenge' => 'توليد عملاء محتملين مؤهلين للمشاريع العقارية الفاخرة',
                'solution' => 'أنشأنا landing pages محسّنة، وحملات إعلانية مستهدفة للمستثمرين، مع نظام CRM متكامل لمتابعة العملاء',
                'results' => [
                    ['metric' => 'عملاء محتملين', 'value' => '+2,400'],
                    ['metric' => 'معدل التأهيل', 'value' => '34%'],
                    ['metric' => 'تكلفة العميل المحتمل', 'value' => '-52%'],
                    ['metric' => 'مبيعات مغلقة', 'value' => '127 وحدة']
                ],
                'services' => ['تطوير Landing Pages', 'Google Ads', 'Facebook Ads', 'نظام CRM', 'أتمتة التسويق'],
                'duration' => '8 أشهر',
                'image' => 'https://via.placeholder.com/800x600/0b0b0c/d4af37?text=DAMAC'
            ],
            [
                'client' => 'Marina Mall',
                'industry' => 'تجزئة',
                'challenge' => 'زيادة عدد الزوار وتحسين التفاعل على وسائل التواصل الاجتماعي',
                'solution' => 'أطلقنا حملة محتوى إبداعية مع مسابقات تفاعلية، وتغطية للفعاليات، وشراكات مع المؤثرين',
                'results' => [
                    ['metric' => 'زيادة المتابعين', 'value' => '185%'],
                    ['metric' => 'معدل التفاعل', 'value' => '15.2%'],
                    ['metric' => 'زيادة الزوار', 'value' => '67%'],
                    ['metric' => 'Reach', 'value' => '+2.5M']
                ],
                'services' => ['إدارة السوشيال ميديا', 'إنتاج المحتوى', 'التسويق بالمؤثرين', 'تغطية الفعاليات'],
                'duration' => '6 أشهر',
                'image' => 'https://via.placeholder.com/800x600/0b0b0c/d4af37?text=Marina+Mall'
            ]
        ];

        foreach ($case_studies as $index => $case): ?>
            <div class="mb-16 <?php echo $index % 2 === 0 ? '' : 'md:flex-row-reverse'; ?>">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <!-- Image -->
                    <div class="<?php echo $index % 2 === 0 ? 'md:order-1' : 'md:order-2'; ?>">
                        <div class="relative rounded-xl overflow-hidden group">
                            <img src="<?php echo $case['image']; ?>" 
                                 alt="<?php echo $case['client']; ?>"
                                 class="w-full h-96 object-cover transition-transform duration-500 group-hover:scale-110"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-dark via-transparent to-transparent opacity-60"></div>
                            <div class="absolute bottom-6 left-6 right-6">
                                <span class="px-3 py-1 bg-primary text-dark text-sm font-semibold rounded-full">
                                    <?php echo $case['industry']; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="<?php echo $index % 2 === 0 ? 'md:order-2' : 'md:order-1'; ?>">
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">
                            <?php echo $case['client']; ?>
                        </h2>

                        <!-- Challenge -->
                        <div class="mb-6">
                            <h3 class="text-primary font-semibold mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                التحدي
                            </h3>
                            <p class="text-gray-300"><?php echo $case['challenge']; ?></p>
                        </div>

                        <!-- Solution -->
                        <div class="mb-6">
                            <h3 class="text-primary font-semibold mb-2 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                الحل
                            </h3>
                            <p class="text-gray-300"><?php echo $case['solution']; ?></p>
                        </div>

                        <!-- Results -->
                        <div class="mb-6">
                            <h3 class="text-primary font-semibold mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                </svg>
                                النتائج
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                <?php foreach ($case['results'] as $result): ?>
                                    <div class="bg-dark-lighter rounded-lg p-4 border border-dark-light hover:border-primary transition-colors">
                                        <div class="text-2xl font-bold gradient-text mb-1">
                                            <?php echo $result['value']; ?>
                                        </div>
                                        <div class="text-sm text-gray-400">
                                            <?php echo $result['metric']; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Services & Duration -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ($case['services'] as $service): ?>
                                <span class="px-3 py-1 bg-dark-lighter border border-primary/30 text-primary text-sm rounded-full">
                                    <?php echo $service; ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <span>المدة: <?php echo $case['duration']; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($index < count($case_studies) - 1): ?>
                <div class="border-t border-dark-light my-16"></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-24 bg-dark-lighter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            هل أنت مستعد لتحقيق نتائج مماثلة؟
        </h2>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            دعنا نساعدك في تحويل أهدافك التسويقية إلى نتائج قابلة للقياس
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo url('contact.php'); ?>" class="px-8 py-4 bg-primary hover:bg-primary-600 text-dark rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2">
                <span>ابدأ مشروعك الآن</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
            <a href="<?php echo url('pricing.php'); ?>" class="px-8 py-4 bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-dark rounded-lg font-semibold transition-all duration-300 inline-flex items-center gap-2">
                <span>شاهد الأسعار</span>
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
