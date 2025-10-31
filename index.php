<?php
$page_title = t('home_title') . ' | ' . SITE_NAME;
$page_description = t('home_description');

require_once 'header.php';

// Get featured portfolio items
$featured_projects = get_portfolio_data(6); // Get 6 featured projects
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content animate-on-scroll">
            <h1>
                <i class="fas fa-robot"></i><br>
                <?php echo t('hero_title'); ?>
            </h1>
            <p><?php echo t('hero_subtitle'); ?></p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <a href="<?php echo SITE_URL; ?>/portfolio.php" class="btn btn-primary">
                    <i class="fas fa-briefcase"></i> <?php echo t('hero_cta_portfolio'); ?>
                </a>
                <a href="<?php echo SITE_URL; ?>/contact.php" class="btn btn-outline">
                    <i class="fas fa-envelope"></i> <?php echo t('hero_cta_contact'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services">
    <div class="container">
        <div class="section-title animate-on-scroll">
            <h2><i class="fas fa-cogs"></i> <?php echo t('services_title'); ?></h2>
            <p><?php echo t('services_subtitle'); ?></p>
        </div>

        <div class="grid grid-3">
            <!-- Service 1: AI Automation -->
            <div class="card animate-on-scroll">
                <div style="font-size: 3rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan); margin-bottom: 1rem;">
                    <i class="fas fa-robot"></i>
                </div>
                <h3><?php echo t('service_ai_title'); ?></h3>
                <p><?php echo t('service_ai_description'); ?></p>
                <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                    <li><i class="fas fa-check" style="color: var(--accent-purple); margin-left: 0.5rem;"></i> <?php echo t('service_ai_feature_1'); ?></li>
                    <li><i class="fas fa-check" style="color: var(--accent-purple); margin-left: 0.5rem;"></i> <?php echo t('service_ai_feature_2'); ?></li>
                    <li><i class="fas fa-check" style="color: var(--accent-purple); margin-left: 0.5rem;"></i> <?php echo t('service_ai_feature_3'); ?></li>
                </ul>
            </div>

            <!-- Service 2: Web Development -->
            <div class="card animate-on-scroll">
                <div style="font-size: 3rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan); margin-bottom: 1rem;">
                    <i class="fas fa-code"></i>
                </div>
                <h3><?php echo t('service_web_title'); ?></h3>
                <p><?php echo t('service_web_description'); ?></p>
                <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                    <li><i class="fas fa-check" style="color: var(--accent-purple); margin-left: 0.5rem;"></i> <?php echo t('service_web_feature_1'); ?></li>
                    <li><i class="fas fa-check" style="color: var(--accent-purple); margin-left: 0.5rem;"></i> <?php echo t('service_web_feature_2'); ?></li>
                    <li><i class="fas fa-check" style="color: var(--accent-purple); margin-left: 0.5rem;"></i> <?php echo t('service_web_feature_3'); ?></li>
                </ul>
            </div>

            <!-- Service 3: Digital Marketing -->
            <div class="card animate-on-scroll">
                <div style="font-size: 3rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan); margin-bottom: 1rem;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3><?php echo t('service_marketing_title'); ?></h3>
                <p><?php echo t('service_marketing_description'); ?></p>
                <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                    <li><i class="fas fa-check" style="color: var(--accent-purple); margin-left: 0.5rem;"></i> <?php echo t('service_marketing_feature_1'); ?></li>
                    <li><i class="fas fa-check" style="color: var(--accent-purple); margin-left: 0.5rem;"></i> <?php echo t('service_marketing_feature_2'); ?></li>
                    <li><i class="fas fa-check" style="color: var(--accent-purple); margin-left: 0.5rem;"></i> <?php echo t('service_marketing_feature_3'); ?></li>
                </ul>
            </div>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="<?php echo SITE_URL; ?>/services.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> <?php echo t('view_all_services'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Featured Portfolio -->
<section id="portfolio">
    <div class="container">
        <div class="section-title animate-on-scroll">
            <h2><i class="fas fa-briefcase"></i> <?php echo t('portfolio_title'); ?></h2>
            <p><?php echo t('portfolio_subtitle'); ?></p>
        </div>

        <div class="grid grid-3">
            <?php foreach ($featured_projects as $project): ?>
                <div class="card animate-on-scroll" style="padding: 0; overflow: hidden;">
                    <?php if (!empty($project['image'])): ?>
                        <img src="<?php echo htmlspecialchars($project['image']); ?>" 
                             alt="<?php echo htmlspecialchars($project['title']); ?>"
                             style="width: 100%; height: 250px; object-fit: cover; border-radius: var(--radius-lg) var(--radius-lg) 0 0;">
                    <?php else: ?>
                        <div style="width: 100%; height: 250px; background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; border-radius: var(--radius-lg) var(--radius-lg) 0 0;">
                            <i class="fas fa-image" style="font-size: 4rem; color: rgba(255,255,255,0.3);"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div style="padding: 1.5rem;">
                        <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($project['title']); ?></h3>
                        <p style="font-size: 0.95rem; color: var(--text-light); margin-bottom: 1rem;">
                            <?php echo htmlspecialchars(mb_substr($project['description'], 0, 100)) . '...'; ?>
                        </p>
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1rem;">
                            <?php 
                            $services = is_array($project['services']) ? $project['services'] : explode(',', $project['services']);
                            foreach (array_slice($services, 0, 3) as $service): 
                            ?>
                                <span style="padding: 0.25rem 0.75rem; background: var(--gradient-card); border: 1px solid var(--accent-purple); border-radius: var(--radius-sm); font-size: 0.85rem;">
                                    <?php echo htmlspecialchars(trim($service)); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        
                        <a href="<?php echo SITE_URL; ?>/portfolio.php#project-<?php echo $project['id']; ?>" class="btn btn-outline" style="width: 100%; padding: 0.75rem;">
                            <i class="fas fa-eye"></i> <?php echo t('view_project'); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="<?php echo SITE_URL; ?>/portfolio.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> <?php echo t('view_all_projects'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section id="why-us">
    <div class="container">
        <div class="section-title animate-on-scroll">
            <h2><i class="fas fa-star"></i> <?php echo t('why_us_title'); ?></h2>
            <p><?php echo t('why_us_subtitle'); ?></p>
        </div>

        <div class="grid grid-2">
            <div class="card animate-on-scroll">
                <div style="font-size: 2.5rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan); margin-bottom: 1rem;">
                    <i class="fas fa-brain"></i>
                </div>
                <h3><?php echo t('why_us_ai_title'); ?></h3>
                <p><?php echo t('why_us_ai_description'); ?></p>
            </div>

            <div class="card animate-on-scroll">
                <div style="font-size: 2.5rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan); margin-bottom: 1rem;">
                    <i class="fas fa-users"></i>
                </div>
                <h3><?php echo t('why_us_team_title'); ?></h3>
                <p><?php echo t('why_us_team_description'); ?></p>
            </div>

            <div class="card animate-on-scroll">
                <div style="font-size: 2.5rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan); margin-bottom: 1rem;">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3><?php echo t('why_us_results_title'); ?></h3>
                <p><?php echo t('why_us_results_description'); ?></p>
            </div>

            <div class="card animate-on-scroll">
                <div style="font-size: 2.5rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan); margin-bottom: 1rem;">
                    <i class="fas fa-headset"></i>
                </div>
                <h3><?php echo t('why_us_support_title'); ?></h3>
                <p><?php echo t('why_us_support_description'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section id="stats">
    <div class="container">
        <div class="grid grid-4">
            <div class="card text-center animate-on-scroll">
                <div style="font-size: 3rem; font-weight: 900; color: var(--electric-cyan); text-shadow: var(--glow-cyan);">
                    500+
                </div>
                <p style="font-size: 1.125rem; font-weight: 600; margin-top: 0.5rem;"><?php echo t('stat_projects'); ?></p>
            </div>

            <div class="card text-center animate-on-scroll">
                <div style="font-size: 3rem; font-weight: 900; color: var(--electric-cyan); text-shadow: var(--glow-cyan);">
                    200+
                </div>
                <p style="font-size: 1.125rem; font-weight: 600; margin-top: 0.5rem;"><?php echo t('stat_clients'); ?></p>
            </div>

            <div class="card text-center animate-on-scroll">
                <div style="font-size: 3rem; font-weight: 900; color: var(--electric-cyan); text-shadow: var(--glow-cyan);">
                    15+
                </div>
                <p style="font-size: 1.125rem; font-weight: 600; margin-top: 0.5rem;"><?php echo t('stat_years'); ?></p>
            </div>

            <div class="card text-center animate-on-scroll">
                <div style="font-size: 3rem; font-weight: 900; color: var(--electric-cyan); text-shadow: var(--glow-cyan);">
                    99%
                </div>
                <p style="font-size: 1.125rem; font-weight: 600; margin-top: 0.5rem;"><?php echo t('stat_satisfaction'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="cta">
    <div class="container">
        <div class="card text-center animate-on-scroll" style="background: var(--gradient-primary); padding: 4rem 2rem;">
            <h2 style="color: white; text-shadow: none; font-size: clamp(2rem, 4vw, 3rem);">
                <?php echo t('cta_title'); ?>
            </h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.25rem; margin: 1.5rem 0 2rem;">
                <?php echo t('cta_subtitle'); ?>
            </p>
            <a href="<?php echo SITE_URL; ?>/contact.php" class="btn" style="background: white; color: var(--bg-deep); font-size: 1.25rem; padding: 1.25rem 3rem;">
                <i class="fas fa-envelope"></i> <?php echo t('cta_button'); ?>
            </a>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>
