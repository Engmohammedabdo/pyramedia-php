<?php
require_once 'config.php';
$page_title = SITE_TITLE;
$page_description = SITE_DESCRIPTION;
include 'header.php';
$portfolio = get_portfolio_data();
$featured_projects = array_slice($portfolio, 0, 6);

// Render Schema markup
render_schema(get_organization_schema());
render_schema(get_local_business_schema());
render_schema(get_website_schema());
render_schema(get_breadcrumb_schema([
    ['name' => 'الرئيسية', 'url' => url()]
]));
?>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Animated Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-dark via-dark-lighter to-dark">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
            <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-accent-gold rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-96 h-96 bg-accent-cyan rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: 2s;"></div>
        </div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
        <div class="animate-fade-in-up">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass mb-8">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-primary"></span>
                </span>
                <span class="text-sm font-medium">مدعوم بالذكاء الاصطناعي</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6 max-w-4xl mx-auto">
                نحوّل أفكارك إلى <span class="gradient-text">نجاحات رقمية</span>
            </h1>

            <!-- Subheading -->
            <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto">
                شركة تسويق إلكتروني مدعومة بالذكاء الاصطناعي
                <br>
                <span class="text-primary font-semibold">+500 مشروع ناجح</span> في التسويق الرقمي والتصميم
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                <a href="<?php echo url('contact.php'); ?>" class="px-8 py-4 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2">
                    <span>ابدأ مشروعك الآن</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="<?php echo url('portfolio.php'); ?>" class="px-8 py-4 bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-lg font-semibold transition-all duration-300 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span>شاهد أعمالنا</span>
                </a>
            </div>

            <!-- Trust Indicators -->
            <div class="flex flex-wrap justify-center items-center gap-8 text-sm text-gray-400">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span>عملاء حكوميون وعالميون</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>15+ سنة خبرة</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                    </svg>
                    <span>99% معدل رضا العملاء</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 md:py-24 bg-dark-lighter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <!-- Stat 1 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 text-primary mb-4">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="text-4xl md:text-5xl font-bold gradient-text mb-2"><?php echo STAT_PROJECTS; ?></div>
                <div class="text-gray-400">مشروع منجز</div>
            </div>

            <!-- Stat 2 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 text-primary mb-4">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                </div>
                <div class="text-4xl md:text-5xl font-bold gradient-text mb-2"><?php echo STAT_CLIENTS; ?></div>
                <div class="text-gray-400">عميل راضٍ</div>
            </div>

            <!-- Stat 3 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 text-primary mb-4">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="text-4xl md:text-5xl font-bold gradient-text mb-2"><?php echo STAT_EXPERIENCE; ?></div>
                <div class="text-gray-400">سنة خبرة</div>
            </div>

            <!-- Stat 4 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary/10 text-primary mb-4">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="text-4xl md:text-5xl font-bold gradient-text mb-2"><?php echo STAT_SATISFACTION; ?></div>
                <div class="text-gray-400">معدل رضا</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-bold leading-tight mb-4">خدماتنا</h2>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                نقدم مجموعة شاملة من الخدمات التسويقية المدعومة بأحدث التقنيات
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $services = [
                [
                    'title' => 'التصميم الجرافيكي',
                    'description' => 'تصاميم إبداعية تعكس هوية علامتك التجارية',
                    'features' => ['هوية بصرية', 'تصميم مطبوعات', 'تصميم إعلانات', 'موشن جرافيك']
                ],
                [
                    'title' => 'إدارة السوشيال ميديا',
                    'description' => 'نبني حضوراً قوياً لعلامتك على منصات التواصل',
                    'features' => ['إنشاء محتوى', 'جدولة منشورات', 'تفاعل مع الجمهور', 'تحليلات وتقارير']
                ],
                [
                    'title' => 'التسويق الرقمي',
                    'description' => 'استراتيجيات تسويقية مدعومة بالذكاء الاصطناعي',
                    'features' => ['إعلانات مدفوعة', 'تحسين محركات البحث', 'التسويق بالمحتوى', 'البريد الإلكتروني']
                ],
                [
                    'title' => 'إنتاج الفيديو',
                    'description' => 'فيديوهات احترافية تحكي قصة علامتك',
                    'features' => ['فيديوهات ترويجية', 'موشن جرافيك', 'فيديوهات توضيحية', 'إنتاج محتوى']
                ],
                [
                    'title' => 'تطوير المواقع',
                    'description' => 'مواقع عصرية وسريعة ومحسّنة للأداء',
                    'features' => ['مواقع شركات', 'متاجر إلكترونية', 'تطبيقات ويب', 'تطبيقات موبايل']
                ],
                [
                    'title' => 'الذكاء الاصطناعي',
                    'description' => 'حلول ذكية لتحسين أداء حملاتك التسويقية',
                    'features' => ['تحليل بيانات', 'إنشاء محتوى ذكي', 'استهداف دقيق', 'تحسين تلقائي']
                ],
            ];

            foreach ($services as $service): ?>
                <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light transition-all duration-300 hover:border-primary hover:shadow-lg hover:shadow-primary/20 hover:-translate-y-1 group">
                    <h3 class="text-2xl font-bold mb-3"><?php echo $service['title']; ?></h3>
                    <p class="text-gray-400 mb-6"><?php echo $service['description']; ?></p>
                    <ul class="space-y-2 mb-6">
                        <?php foreach ($service['features'] as $feature): ?>
                            <li class="flex items-center gap-2 text-sm text-gray-300">
                                <svg class="w-5 h-5 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span><?php echo $feature; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo url('services.php'); ?>" class="inline-flex items-center gap-2 text-primary hover:gap-3 transition-all duration-300">
                        <span>اعرف المزيد</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Portfolio Preview Section -->
<section class="py-16 md:py-24 bg-dark-lighter">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-bold leading-tight mb-4">سابقة أعمالنا</h2>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                نفخر بتقديم حلول تسويقية مبتكرة لعملائنا من القطاعين الحكومي والخاص
            </p>
        </div>

        <!-- Portfolio Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <?php foreach ($featured_projects as $project): ?>
                <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light transition-all duration-300 hover:border-primary hover:shadow-lg hover:shadow-primary/20 hover:-translate-y-1 group overflow-hidden">
                    <!-- Project Image Placeholder -->
                    <div class="relative h-48 bg-gradient-to-br from-primary/20 to-accent-gold/20 rounded-lg mb-6 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-6xl font-bold text-white/10">
                                <?php echo mb_substr($project['client_name'], 0, 1); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Project Info -->
                    <div>
                        <!-- Category Badge -->
                        <span class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-medium mb-3">
                            <?php echo $project['category']; ?>
                        </span>

                        <!-- Client Name -->
                        <h3 class="text-xl font-bold mb-2"><?php echo $project['client_name']; ?></h3>

                        <!-- Project Title -->
                        <p class="text-gray-400 mb-4"><?php echo $project['project_title']; ?></p>

                        <!-- Services -->
                        <div class="flex flex-wrap gap-2">
                            <?php foreach (array_slice($project['services'], 0, 2) as $service): ?>
                                <span class="px-2 py-1 rounded text-xs bg-dark text-gray-300">
                                    <?php echo $service; ?>
                                </span>
                            <?php endforeach; ?>
                            <?php if (count($project['services']) > 2): ?>
                                <span class="px-2 py-1 rounded text-xs bg-dark text-gray-300">
                                    +<?php echo count($project['services']) - 2; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- View All Button -->
        <div class="text-center">
            <a href="<?php echo url('portfolio.php'); ?>" class="px-8 py-4 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2">
                <span>شاهد جميع الأعمال</span>
                <span class="text-xl">(<?php echo count($portfolio); ?>)</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-24 relative overflow-hidden">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-r from-primary via-accent-gold to-primary opacity-10"></div>
    
    <!-- Animated Circles -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-1/2 -right-1/2 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-1/2 -left-1/2 w-96 h-96 bg-accent-gold rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float" style="animation-delay: 1s;"></div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Icon -->
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary/10 text-primary mb-8">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>

            <!-- Heading -->
            <h2 class="text-3xl md:text-5xl font-bold leading-tight mb-6">
                جاهز لتحويل عملك إلى <span class="gradient-text">قصة نجاح</span>؟
            </h2>

            <!-- Description -->
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                انضم إلى +200 عميل راضٍ واحصل على استشارة مجانية لمشروعك القادم
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
                <a href="<?php echo url('contact.php'); ?>" class="px-8 py-4 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2 text-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    <span>احصل على استشارة مجانية</span>
                </a>
                
                <a href="tel:<?php echo str_replace(' ', '', CONTACT_PHONE); ?>" class="px-8 py-4 bg-transparent border-2 border-primary text-primary hover:bg-primary hover:text-white rounded-lg font-semibold transition-all duration-300 inline-flex items-center gap-2 text-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>اتصل بنا الآن</span>
                </a>
            </div>

            <!-- Trust Indicators -->
            <div class="flex flex-wrap justify-center items-center gap-8 text-sm text-gray-400">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>استشارة مجانية</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>رد سريع خلال 24 ساعة</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>خطة عمل مخصصة</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
