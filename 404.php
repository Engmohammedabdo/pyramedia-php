<?php
$page_title = 'الصفحة غير موجودة - 404';
include 'header.php';
?>

<!-- 404 Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-dark via-dark-lighter to-dark">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
            <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-accent-gold rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: 1s;"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        <!-- 404 Number -->
        <div class="mb-8">
            <h1 class="text-[200px] md:text-[300px] font-bold leading-none gradient-text opacity-20">
                404
            </h1>
        </div>

        <!-- Content -->
        <div class="-mt-32 md:-mt-48">
            <!-- Icon -->
            <div class="mb-8 flex justify-center">
                <div class="w-32 h-32 rounded-full bg-primary/10 flex items-center justify-center animate-bounce">
                    <svg class="w-16 h-16 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold mb-4">
                عذراً، الصفحة غير موجودة!
            </h2>

            <!-- Description -->
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                يبدو أن الصفحة التي تبحث عنها قد تم نقلها أو حذفها أو لم تكن موجودة أصلاً.
            </p>

            <!-- Suggestions -->
            <div class="bg-dark-lighter rounded-xl p-8 mb-8 border border-dark-light max-w-2xl mx-auto">
                <h3 class="text-xl font-semibold mb-4 text-primary">جرّب هذه الخيارات:</h3>
                <ul class="space-y-3 text-right">
                    <li class="flex items-center gap-3 text-gray-300">
                        <svg class="w-5 h-5 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>تحقق من عنوان URL للتأكد من كتابته بشكل صحيح</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-300">
                        <svg class="w-5 h-5 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>ارجع إلى الصفحة السابقة</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-300">
                        <svg class="w-5 h-5 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>ابدأ من الصفحة الرئيسية</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-300">
                        <svg class="w-5 h-5 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>تواصل معنا إذا كنت بحاجة إلى مساعدة</span>
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo url(); ?>" 
                   class="px-8 py-4 bg-primary hover:bg-primary-600 text-dark rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>العودة للرئيسية</span>
                </a>
                <button onclick="history.back()" 
                        class="px-8 py-4 bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-dark rounded-lg font-semibold transition-all duration-300 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>الصفحة السابقة</span>
                </button>
            </div>

            <!-- Quick Links -->
            <div class="mt-12 pt-8 border-t border-dark-light">
                <p class="text-gray-400 mb-4">أو تصفح أقسامنا الشائعة:</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?php echo url('services.php'); ?>" 
                       class="px-4 py-2 bg-dark-lighter hover:bg-dark-light text-gray-300 hover:text-primary rounded-lg transition-colors duration-300 text-sm">
                        خدماتنا
                    </a>
                    <a href="<?php echo url('portfolio.php'); ?>" 
                       class="px-4 py-2 bg-dark-lighter hover:bg-dark-light text-gray-300 hover:text-primary rounded-lg transition-colors duration-300 text-sm">
                        أعمالنا
                    </a>
                    <a href="<?php echo url('pricing.php'); ?>" 
                       class="px-4 py-2 bg-dark-lighter hover:bg-dark-light text-gray-300 hover:text-primary rounded-lg transition-colors duration-300 text-sm">
                        الأسعار
                    </a>
                    <a href="<?php echo url('case-studies.php'); ?>" 
                       class="px-4 py-2 bg-dark-lighter hover:bg-dark-light text-gray-300 hover:text-primary rounded-lg transition-colors duration-300 text-sm">
                        دراسات الحالة
                    </a>
                    <a href="<?php echo url('about.php'); ?>" 
                       class="px-4 py-2 bg-dark-lighter hover:bg-dark-light text-gray-300 hover:text-primary rounded-lg transition-colors duration-300 text-sm">
                        من نحن
                    </a>
                    <a href="<?php echo url('contact.php'); ?>" 
                       class="px-4 py-2 bg-dark-lighter hover:bg-dark-light text-gray-300 hover:text-primary rounded-lg transition-colors duration-300 text-sm">
                        تواصل معنا
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
