<?php
require_once 'config.php';
$page_title = 'الأسعار';
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
            <span class="gradient-text">الأسعار</span> والباقات
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto">
            اختر الباقة المناسبة لاحتياجاتك وابدأ رحلة النجاح الرقمي
        </p>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Pricing Toggle (Monthly/Yearly) -->
        <div class="flex justify-center items-center gap-4 mb-12">
            <span class="text-lg" id="monthly-label">شهري</span>
            <button onclick="togglePricing()" class="relative w-16 h-8 bg-dark-lighter rounded-full transition-colors duration-300" id="pricing-toggle">
                <div class="absolute top-1 right-1 w-6 h-6 bg-primary rounded-full transition-transform duration-300" id="toggle-slider"></div>
            </button>
            <span class="text-lg text-gray-400" id="yearly-label">سنوي</span>
            <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-sm font-semibold">وفّر 20%</span>
        </div>

        <!-- Pricing Cards -->
        <div class="grid md:grid-cols-3 gap-8">
            <?php
            $packages = [
                [
                    'name' => 'الباقة الأساسية',
                    'name_en' => 'Starter',
                    'description' => 'مثالية للشركات الناشئة والمشاريع الصغيرة',
                    'price_monthly' => '999',
                    'price_yearly' => '9,590',
                    'features' => [
                        'تصميم موقع احترافي (5 صفحات)',
                        'تصميم شعار ومواد تسويقية',
                        'إدارة حساب سوشيال ميديا واحد',
                        '10 منشورات شهرياً',
                        'دعم فني عبر البريد',
                        'تقرير شهري'
                    ],
                    'cta' => 'ابدأ الآن',
                    'popular' => false
                ],
                [
                    'name' => 'الباقة الاحترافية',
                    'name_en' => 'Professional',
                    'description' => 'الأنسب للشركات المتوسطة والمتنامية',
                    'price_monthly' => '2,499',
                    'price_yearly' => '23,990',
                    'features' => [
                        'تصميم موقع متقدم (10 صفحات)',
                        'هوية بصرية كاملة',
                        'إدارة 3 حسابات سوشيال ميديا',
                        '30 منشور شهرياً + فيديوهات',
                        'حملات إعلانية (Google + Facebook)',
                        'SEO متقدم',
                        'دعم فني مباشر',
                        'تقارير أسبوعية'
                    ],
                    'cta' => 'الأكثر شعبية',
                    'popular' => true
                ],
                [
                    'name' => 'الباقة المتكاملة',
                    'name_en' => 'Enterprise',
                    'description' => 'حلول شاملة للشركات الكبرى',
                    'price_monthly' => '4,999',
                    'price_yearly' => '47,990',
                    'features' => [
                        'موقع ويب مخصص بالكامل',
                        'تطبيق موبايل (iOS + Android)',
                        'هوية بصرية + دليل استخدام',
                        'إدارة كاملة لجميع المنصات',
                        '60+ منشور + محتوى فيديو',
                        'حملات إعلانية متقدمة',
                        'AI Chatbot ذكي',
                        'أتمتة تسويقية (n8n)',
                        'مدير حساب مخصص',
                        'دعم 24/7',
                        'تقارير يومية'
                    ],
                    'cta' => 'تواصل معنا',
                    'popular' => false
                ],
            ];

            foreach ($packages as $index => $package): ?>
                <div class="relative <?php echo $package['popular'] ? 'md:-mt-4' : ''; ?>">
                    <?php if ($package['popular']): ?>
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 px-4 py-1 bg-primary text-dark rounded-full text-sm font-bold">
                            الأكثر شعبية
                        </div>
                    <?php endif; ?>
                    
                    <div class="h-full bg-dark-lighter rounded-xl p-8 border <?php echo $package['popular'] ? 'border-primary shadow-lg shadow-primary/20' : 'border-dark-light'; ?> transition-all duration-300 hover:border-primary hover:-translate-y-1">
                        <!-- Package Header -->
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold mb-2"><?php echo $package['name']; ?></h3>
                            <p class="text-sm text-gray-400 mb-6"><?php echo $package['description']; ?></p>
                            
                            <!-- Price -->
                            <div class="mb-6">
                                <div class="price-monthly">
                                    <span class="text-4xl font-bold gradient-text"><?php echo $package['price_monthly']; ?></span>
                                    <span class="text-gray-400"> درهم/شهر</span>
                                </div>
                                <div class="price-yearly hidden">
                                    <span class="text-4xl font-bold gradient-text"><?php echo $package['price_yearly']; ?></span>
                                    <span class="text-gray-400"> درهم/سنة</span>
                                </div>
                            </div>
                        </div>

                        <!-- Features -->
                        <ul class="space-y-4 mb-8">
                            <?php foreach ($package['features'] as $feature): ?>
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-gray-300"><?php echo $feature; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- CTA Button -->
                        <a href="<?php echo url('contact.php'); ?>" 
                           class="block w-full px-6 py-4 <?php echo $package['popular'] ? 'bg-primary hover:bg-primary-600 text-dark' : 'bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-dark'; ?> rounded-lg font-semibold text-center transition-all duration-300">
                            <?php echo $package['cta']; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Additional Info -->
        <div class="mt-16 text-center">
            <p class="text-gray-400 mb-6">
                جميع الباقات تشمل استشارة مجانية وضمان استرداد المال خلال 30 يوماً
            </p>
            <div class="flex flex-wrap justify-center gap-8 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>دفع آمن</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>بدون رسوم خفية</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>إلغاء في أي وقت</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 md:py-24 bg-dark-lighter">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">الأسئلة الشائعة</h2>
        
        <div class="space-y-4">
            <?php
            $faqs = [
                [
                    'question' => 'هل يمكنني تغيير الباقة لاحقاً؟',
                    'answer' => 'نعم، يمكنك الترقية أو التخفيض في أي وقت. سنقوم بحساب الفرق بشكل عادل.'
                ],
                [
                    'question' => 'ما هي طرق الدفع المتاحة؟',
                    'answer' => 'نقبل جميع طرق الدفع: بطاقات الائتمان، التحويل البنكي، PayPal، وApple Pay.'
                ],
                [
                    'question' => 'هل تقدمون خصومات للمؤسسات الكبيرة؟',
                    'answer' => 'نعم، نقدم خصومات خاصة للمؤسسات الكبيرة والعقود طويلة الأجل. تواصل معنا للحصول على عرض مخصص.'
                ],
                [
                    'question' => 'كم يستغرق تنفيذ المشروع؟',
                    'answer' => 'يعتمد على الباقة المختارة: الأساسية (2-3 أسابيع)، الاحترافية (4-6 أسابيع)، المتكاملة (8-12 أسبوع).'
                ],
                [
                    'question' => 'هل يشمل السعر الاستضافة والدومين؟',
                    'answer' => 'الباقة الأساسية لا تشمل الاستضافة. الباقتان الاحترافية والمتكاملة تشملان استضافة مجانية لمدة سنة.'
                ],
            ];

            foreach ($faqs as $index => $faq): ?>
                <div class="bg-dark rounded-xl border border-dark-light overflow-hidden">
                    <button onclick="toggleFaq(<?php echo $index; ?>)" 
                            class="w-full px-6 py-4 flex items-center justify-between text-right hover:bg-dark-lighter transition-colors">
                        <span class="font-semibold"><?php echo $faq['question']; ?></span>
                        <svg class="w-5 h-5 text-primary transform transition-transform faq-icon-<?php echo $index; ?>" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer-<?php echo $index; ?> hidden px-6 pb-4 text-gray-400">
                        <?php echo $faq['answer']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            لا تزال لديك أسئلة؟
        </h2>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            تواصل معنا للحصول على استشارة مجانية وعرض سعر مخصص لاحتياجاتك
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo url('contact.php'); ?>" class="px-8 py-4 bg-primary hover:bg-primary-600 text-dark rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2">
                <span>تواصل معنا الآن</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
            <a href="<?php echo url('portfolio.php'); ?>" class="px-8 py-4 bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-dark rounded-lg font-semibold transition-all duration-300 inline-flex items-center gap-2">
                <span>شاهد أعمالنا</span>
            </a>
        </div>
    </div>
</section>

<script>
// Pricing Toggle
let isYearly = false;

function togglePricing() {
    isYearly = !isYearly;
    const slider = document.getElementById('toggle-slider');
    const monthlyPrices = document.querySelectorAll('.price-monthly');
    const yearlyPrices = document.querySelectorAll('.price-yearly');
    const monthlyLabel = document.getElementById('monthly-label');
    const yearlyLabel = document.getElementById('yearly-label');
    
    if (isYearly) {
        slider.style.transform = 'translateX(-2rem)';
        monthlyPrices.forEach(el => el.classList.add('hidden'));
        yearlyPrices.forEach(el => el.classList.remove('hidden'));
        monthlyLabel.classList.add('text-gray-400');
        monthlyLabel.classList.remove('text-white');
        yearlyLabel.classList.remove('text-gray-400');
        yearlyLabel.classList.add('text-white');
    } else {
        slider.style.transform = 'translateX(0)';
        monthlyPrices.forEach(el => el.classList.remove('hidden'));
        yearlyPrices.forEach(el => el.classList.add('hidden'));
        monthlyLabel.classList.remove('text-gray-400');
        monthlyLabel.classList.add('text-white');
        yearlyLabel.classList.add('text-gray-400');
        yearlyLabel.classList.remove('text-white');
    }
}

// FAQ Toggle
function toggleFaq(index) {
    const answer = document.querySelector(`.faq-answer-${index}`);
    const icon = document.querySelector(`.faq-icon-${index}`);
    
    answer.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>

<?php include 'footer.php'; ?>
