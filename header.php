<?php
require_once 'config.php';
require_once 'i18n.php';
require_once 'schema.php';
$current_page = get_current_page();

// Set default SEO values
$page_title = $page_title ?? SITE_TITLE;
$page_description = $page_description ?? SITE_DESCRIPTION;
$page_image = $page_image ?? SITE_URL . '/assets/og-image.jpg';
$page_url = SITE_URL . $_SERVER['REQUEST_URI'];
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
    
    <!-- Gradient Mesh Tech CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/gradient-mesh.css">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Additional Page Styles -->
    <style>
        /* Page-specific overrides can go here */
    </style>
    
    <?php if (isset($additional_head)): ?>
        <?php echo $additional_head; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Floating Geometric Shapes Background -->
    <div class="floating-shapes">
        <div class="shape shape-circle" style="top: 10%; left: 10%; width: 300px; height: 300px;"></div>
        <div class="shape shape-square" style="top: 60%; right: 15%; width: 200px; height: 200px;"></div>
        <div class="shape shape-pentagon" style="bottom: 20%; left: 20%; width: 250px; height: 250px;"></div>
        <div class="shape shape-circle" style="top: 30%; right: 30%; width: 180px; height: 180px;"></div>
        <div class="shape shape-square" style="bottom: 40%; right: 10%; width: 220px; height: 220px;"></div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <!-- Logo -->
                <a href="<?php echo SITE_URL; ?>/" class="logo">
                    <i class="fas fa-robot"></i> <?php echo SITE_NAME; ?>
                </a>

                <!-- Desktop Navigation -->
                <ul class="nav-links desktop-nav">
                    <li><a href="<?php echo SITE_URL; ?>/" class="<?php echo $current_page == 'index' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> <?php echo t('nav_home'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/portfolio.php" class="<?php echo $current_page == 'portfolio' ? 'active' : ''; ?>">
                        <i class="fas fa-briefcase"></i> <?php echo t('nav_portfolio'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/services.php" class="<?php echo $current_page == 'services' ? 'active' : ''; ?>">
                        <i class="fas fa-cogs"></i> <?php echo t('nav_services'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/pricing.php" class="<?php echo $current_page == 'pricing' ? 'active' : ''; ?>">
                        <i class="fas fa-tags"></i> <?php echo t('nav_pricing'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/case-studies.php" class="<?php echo $current_page == 'case-studies' ? 'active' : ''; ?>">
                        <i class="fas fa-chart-line"></i> <?php echo t('nav_case_studies'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/contact.php" class="<?php echo $current_page == 'contact' ? 'active' : ''; ?>">
                        <i class="fas fa-envelope"></i> <?php echo t('nav_contact'); ?>
                    </a></li>
                    
                    <!-- Language Switcher -->
                    <li class="lang-switcher">
                        <?php if (get_lang() == 'ar'): ?>
                            <a href="<?php echo SITE_URL; ?>/switch_lang.php?lang=en&redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn-lang">
                                <i class="fas fa-globe"></i> EN
                            </a>
                        <?php else: ?>
                            <a href="<?php echo SITE_URL; ?>/switch_lang.php?lang=ar&redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn-lang">
                                <i class="fas fa-globe"></i> عربي
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle Menu">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>

            <!-- Mobile Navigation -->
            <div class="mobile-nav" id="mobileNav">
                <ul class="mobile-nav-links">
                    <li><a href="<?php echo SITE_URL; ?>/" class="<?php echo $current_page == 'index' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> <?php echo t('nav_home'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/portfolio.php" class="<?php echo $current_page == 'portfolio' ? 'active' : ''; ?>">
                        <i class="fas fa-briefcase"></i> <?php echo t('nav_portfolio'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/services.php" class="<?php echo $current_page == 'services' ? 'active' : ''; ?>">
                        <i class="fas fa-cogs"></i> <?php echo t('nav_services'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/pricing.php" class="<?php echo $current_page == 'pricing' ? 'active' : ''; ?>">
                        <i class="fas fa-tags"></i> <?php echo t('nav_pricing'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/case-studies.php" class="<?php echo $current_page == 'case-studies' ? 'active' : ''; ?>">
                        <i class="fas fa-chart-line"></i> <?php echo t('nav_case_studies'); ?>
                    </a></li>
                    <li><a href="<?php echo SITE_URL; ?>/contact.php" class="<?php echo $current_page == 'contact' ? 'active' : ''; ?>">
                        <i class="fas fa-envelope"></i> <?php echo t('nav_contact'); ?>
                    </a></li>
                    <li class="lang-switcher-mobile">
                        <?php if (get_lang() == 'ar'): ?>
                            <a href="<?php echo SITE_URL; ?>/switch_lang.php?lang=en&redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
                                <i class="fas fa-globe"></i> English
                            </a>
                        <?php else: ?>
                            <a href="<?php echo SITE_URL; ?>/switch_lang.php?lang=ar&redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
                                <i class="fas fa-globe"></i> عربي
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Add spacing for fixed header -->
    <div style="height: 80px;"></div>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileNav = document.getElementById('mobileNav');
            
            if (mobileMenuToggle && mobileNav) {
                mobileMenuToggle.addEventListener('click', function() {
                    mobileNav.classList.toggle('active');
                    const icon = this.querySelector('i');
                    if (mobileNav.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }

            // Scroll Animation
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>

    <style>
        /* Mobile Navigation Styles */
        .desktop-nav {
            display: flex;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--electric-cyan);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-nav {
            display: none;
            position: fixed;
            top: 80px;
            left: 0;
            width: 100%;
            background: rgba(26, 11, 46, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(124, 58, 237, 0.3);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .mobile-nav.active {
            max-height: 500px;
        }

        .mobile-nav-links {
            list-style: none;
            padding: 1rem 0;
        }

        .mobile-nav-links li {
            margin: 0;
        }

        .mobile-nav-links a {
            display: block;
            padding: 1rem 2rem;
            color: var(--text-light);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .mobile-nav-links a:hover,
        .mobile-nav-links a.active {
            background: var(--gradient-hover);
            color: var(--electric-cyan);
            text-shadow: var(--glow-cyan);
        }

        .mobile-nav-links i {
            margin-left: 0.5rem;
            width: 20px;
            text-align: center;
        }

        .btn-lang {
            padding: 0.5rem 1rem !important;
            background: var(--gradient-card);
            border: 1px solid var(--accent-purple);
            border-radius: var(--radius-sm);
        }

        .btn-lang:hover {
            background: var(--gradient-hover);
            border-color: var(--electric-cyan);
        }

        @media (max-width: 1024px) {
            .desktop-nav {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .mobile-nav {
                display: block;
            }
        }

        /* RTL Support */
        [dir="rtl"] .nav-links i,
        [dir="rtl"] .mobile-nav-links i {
            margin-left: 0;
            margin-right: 0.5rem;
        }
    </style>
