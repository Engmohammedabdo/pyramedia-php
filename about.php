<?php
$page_title = 'من نحن';
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
            من <span class="gradient-text">نحن</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto">
            شركة تسويق إلكتروني رائدة مدعومة بالذكاء الاصطناعي في الإمارات العربية المتحدة
        </p>
    </div>
</section>

<!-- About Content -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center mb-24">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    نحوّل الأفكار إلى <span class="gradient-text">نجاحات رقمية</span>
                </h2>
                <p class="text-lg text-gray-300 mb-6">
                    <strong class="text-white">Pyramedia</strong> هي شركة تسويق إلكتروني متخصصة في تقديم حلول تسويقية مبتكرة مدعومة بأحدث تقنيات الذكاء الاصطناعي. نساعد الشركات والمؤسسات على بناء حضور رقمي قوي وتحقيق أهدافها التسويقية.
                </p>
                <p class="text-lg text-gray-300 mb-6">
                    مع خبرة تمتد لأكثر من <strong class="text-primary">15 عاماً</strong> في المجال، نجحنا في تنفيذ أكثر من <strong class="text-primary">500 مشروع</strong> لعملاء من القطاعين الحكومي والخاص، بما في ذلك مؤسسات حكومية كبرى وعلامات تجارية عالمية.
                </p>
                <div class="flex gap-4">
                    <a href="<?php echo url('contact.php'); ?>" class="px-6 py-3 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2">
                        <span>تواصل معنا</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-square bg-gradient-to-br from-primary/20 to-accent-gold/20 rounded-2xl flex items-center justify-center">
                    <div class="text-9xl font-bold text-white/10">P</div>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="mb-24">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">قيمنا</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-dark-lighter rounded-xl p-8 border border-dark-light text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 text-primary mb-6">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">الابتكار</h3>
                    <p class="text-gray-400">
                        نستخدم أحدث التقنيات والأساليب المبتكرة لتقديم حلول تسويقية فريدة ومؤثرة
                    </p>
                </div>

                <div class="bg-dark-lighter rounded-xl p-8 border border-dark-light text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 text-primary mb-6">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">التعاون</h3>
                    <p class="text-gray-400">
                        نعمل كشركاء مع عملائنا لفهم احتياجاتهم وتحقيق أهدافهم التسويقية
                    </p>
                </div>

                <div class="bg-dark-lighter rounded-xl p-8 border border-dark-light text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 text-primary mb-6">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">الجودة</h3>
                    <p class="text-gray-400">
                        نلتزم بأعلى معايير الجودة في كل مشروع نقوم به لضمان رضا عملائنا
                    </p>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">لماذا تختارنا؟</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <?php
                $reasons = [
                    [
                        'title' => 'خبرة واسعة',
                        'description' => '+15 سنة من الخبرة في التسويق الرقمي والتصميم'
                    ],
                    [
                        'title' => 'فريق محترف',
                        'description' => 'فريق من المتخصصين في التسويق والتصميم والتطوير'
                    ],
                    [
                        'title' => 'تقنيات حديثة',
                        'description' => 'استخدام أحدث التقنيات والأدوات في المجال'
                    ],
                    [
                        'title' => 'نتائج مضمونة',
                        'description' => 'سجل حافل من النجاحات مع معدل رضا 99%'
                    ],
                    [
                        'title' => 'دعم مستمر',
                        'description' => 'دعم فني ومتابعة مستمرة لضمان نجاح مشروعك'
                    ],
                    [
                        'title' => 'أسعار تنافسية',
                        'description' => 'حلول تسويقية فعالة بأسعار مناسبة لجميع الميزانيات'
                    ],
                ];

                foreach ($reasons as $reason): ?>
                    <div class="flex gap-4 p-6 bg-dark-lighter rounded-xl border border-dark-light hover:border-primary transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2"><?php echo $reason['title']; ?></h3>
                            <p class="text-gray-400"><?php echo $reason['description']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-24 bg-dark-lighter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">
            هل أنت جاهز للبدء؟
        </h2>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            دعنا نساعدك في تحقيق أهدافك التسويقية وبناء حضور رقمي قوي لعلامتك التجارية
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo url('contact.php'); ?>" class="px-8 py-4 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2">
                <span>ابدأ مشروعك الآن</span>
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

