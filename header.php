<?php
require_once 'config.php';
require_once 'i18n.php';
require_once 'schema.php';
$current_page = get_current_page();

// Set default SEO values
$page_title = $page_title ?? SITE_TITLE;
$page_description = $page_description ?? SITE_DESCRIPTION;
$page_image = $page_image ?? 'http://pyramedia.72.61.148.81.sslip.io/assets/og-image.jpg';
$page_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="<?php echo lang_code(); ?>" dir="<?php echo lang_dir(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="keywords" content="<?php echo SITE_KEYWORDS; ?>">
    <meta name="author" content="<?php echo SITE_NAME; ?>">
    <meta name="robots" content="index, follow">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo htmlspecialchars($page_url); ?>">
    
    <?php render_og_tags($page_title, $page_description, $page_image, $page_url); ?>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#d4af37',  // Gold
                            50: '#faf8f0',
                            100: '#f5f0dd',
                            200: '#ebe1bb',
                            300: '#e0d299',
                            400: '#d6c377',
                            500: '#d4af37',
                            600: '#c19a1f',
                            700: '#9a7b19',
                            800: '#735c13',
                            900: '#4c3d0d',
                        },
                        dark: {
                            DEFAULT: '#0b0b0c',  // Deep black
                            lighter: '#1A1A1A',
                            light: '#2A2A2A',
                        },
                        muted: '#9aa0a6',
                        accent: {
                            cyan: '#00D9FF',
                            gold: '#d4af37',
                        }
                    },
                    fontFamily: {
                        arabic: ['Cairo', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #d4af37 0%, #f5f0dd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body class="bg-dark text-white">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="<?php echo url(); ?>" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-accent-gold flex items-center justify-center">
                        <span class="text-white font-bold text-xl">P</span>
                    </div>
                    <span class="text-2xl font-bold gradient-text">PYRAMEDIA</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="<?php echo url(); ?>" 
                       class="text-gray-300 hover:text-primary transition-colors duration-300 <?php echo $current_page === 'index' ? 'text-primary' : ''; ?>">
                        <?php echo t('nav.home'); ?>
                    </a>
                    <a href="<?php echo url('services.php'); ?>" 
                       class="text-gray-300 hover:text-primary transition-colors duration-300 <?php echo $current_page === 'services' ? 'text-primary' : ''; ?>">
                        <?php echo t('nav.services'); ?>
                    </a>
                    <a href="<?php echo url('portfolio.php'); ?>" 
                       class="text-gray-300 hover:text-primary transition-colors duration-300 <?php echo $current_page === 'portfolio' ? 'text-primary' : ''; ?>">
                        <?php echo t('nav.portfolio'); ?>
                    </a>
                    <a href="<?php echo url('case-studies.php'); ?>" 
                       class="text-gray-300 hover:text-primary transition-colors duration-300 <?php echo $current_page === 'case-studies' ? 'text-primary' : ''; ?>">
                        <?php echo t('nav.case_studies'); ?>
                    </a>
                    <a href="<?php echo url('pricing.php'); ?>" 
                       class="text-gray-300 hover:text-primary transition-colors duration-300 <?php echo $current_page === 'pricing' ? 'text-primary' : ''; ?>">
                        <?php echo t('nav.pricing'); ?>
                    </a>
                    <a href="<?php echo url('contact.php'); ?>" 
                       class="text-gray-300 hover:text-primary transition-colors duration-300 <?php echo $current_page === 'contact' ? 'text-primary' : ''; ?>">
                        <?php echo t('nav.contact'); ?>
                    </a>
                </div>

                <!-- Language Switcher -->
                <div class="hidden md:block">
                    <a href="<?php echo url('switch_lang.php?lang=' . get_other_lang() . '&redirect=' . urlencode($_SERVER['REQUEST_URI'])); ?>" 
                       class="px-4 py-2 rounded-lg hover:bg-white/5 transition-colors inline-flex items-center gap-2 text-gray-300 hover:text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                        <span><?php echo get_lang_name(get_other_lang()); ?></span>
                    </a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block">
                    <a href="<?php echo url('contact.php'); ?>" 
                       class="px-6 py-3 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center gap-2">
                        <span><?php echo t('home.hero_cta'); ?></span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-white/5 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden py-4 border-t border-white/10">
                <div class="flex flex-col gap-4">
                    <a href="<?php echo url(); ?>" class="text-gray-300 hover:text-primary transition-colors duration-300 py-2"><?php echo t('nav.home'); ?></a>
                    <a href="<?php echo url('services.php'); ?>" class="text-gray-300 hover:text-primary transition-colors duration-300 py-2"><?php echo t('nav.services'); ?></a>
                    <a href="<?php echo url('portfolio.php'); ?>" class="text-gray-300 hover:text-primary transition-colors duration-300 py-2"><?php echo t('nav.portfolio'); ?></a>
                    <a href="<?php echo url('case-studies.php'); ?>" class="text-gray-300 hover:text-primary transition-colors duration-300 py-2"><?php echo t('nav.case_studies'); ?></a>
                    <a href="<?php echo url('pricing.php'); ?>" class="text-gray-300 hover:text-primary transition-colors duration-300 py-2"><?php echo t('nav.pricing'); ?></a>
                    <a href="<?php echo url('contact.php'); ?>" class="text-gray-300 hover:text-primary transition-colors duration-300 py-2"><?php echo t('nav.contact'); ?></a>
                    <a href="<?php echo url('switch_lang.php?lang=' . get_other_lang() . '&redirect=' . urlencode($_SERVER['REQUEST_URI'])); ?>" class="text-gray-300 hover:text-primary transition-colors duration-300 py-2 inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                        </svg>
                        <span><?php echo get_lang_name(get_other_lang()); ?></span>
                    </a>
                    <a href="<?php echo url('contact.php'); ?>" class="px-6 py-3 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 text-center">
                        <?php echo t('home.hero_cta'); ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

