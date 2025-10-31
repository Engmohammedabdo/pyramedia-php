    <!-- Footer -->
    <footer style="background: rgba(26, 11, 46, 0.95); border-top: 1px solid rgba(124, 58, 237, 0.3); padding: 3rem 0 1.5rem; margin-top: 4rem;">
        <div class="container">
            <div class="grid grid-4" style="margin-bottom: 3rem;">
                <!-- Company Info -->
                <div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-robot" style="color: var(--electric-cyan);"></i> 
                        <span style="background: var(--gradient-text); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"><?php echo SITE_NAME; ?></span>
                    </h3>
                    <p style="color: var(--text-light); margin-bottom: 1rem; line-height: 1.6;">
                        <?php echo t('footer_description'); ?>
                    </p>
                    <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                        <?php if (defined('SOCIAL_FACEBOOK') && SOCIAL_FACEBOOK): ?>
                            <a href="<?php echo SOCIAL_FACEBOOK; ?>" target="_blank" rel="noopener" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--gradient-card); border: 1px solid var(--accent-purple); border-radius: 50%; color: var(--text-light); transition: all 0.3s;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (defined('SOCIAL_TWITTER') && SOCIAL_TWITTER): ?>
                            <a href="<?php echo SOCIAL_TWITTER; ?>" target="_blank" rel="noopener" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--gradient-card); border: 1px solid var(--accent-purple); border-radius: 50%; color: var(--text-light); transition: all 0.3s;">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (defined('SOCIAL_INSTAGRAM') && SOCIAL_INSTAGRAM): ?>
                            <a href="<?php echo SOCIAL_INSTAGRAM; ?>" target="_blank" rel="noopener" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--gradient-card); border: 1px solid var(--accent-purple); border-radius: 50%; color: var(--text-light); transition: all 0.3s;">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (defined('SOCIAL_LINKEDIN') && SOCIAL_LINKEDIN): ?>
                            <a href="<?php echo SOCIAL_LINKEDIN; ?>" target="_blank" rel="noopener" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--gradient-card); border: 1px solid var(--accent-purple); border-radius: 50%; color: var(--text-light); transition: all 0.3s;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 style="font-size: 1.125rem; margin-bottom: 1rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan);">
                        <?php echo t('footer_quick_links'); ?>
                    </h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.75rem;">
                            <a href="<?php echo SITE_URL; ?>/" style="color: var(--text-light); transition: all 0.3s; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-chevron-left" style="font-size: 0.75rem;"></i> <?php echo t('nav_home'); ?>
                            </a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="<?php echo SITE_URL; ?>/portfolio.php" style="color: var(--text-light); transition: all 0.3s; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-chevron-left" style="font-size: 0.75rem;"></i> <?php echo t('nav_portfolio'); ?>
                            </a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="<?php echo SITE_URL; ?>/services.php" style="color: var(--text-light); transition: all 0.3s; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-chevron-left" style="font-size: 0.75rem;"></i> <?php echo t('nav_services'); ?>
                            </a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="<?php echo SITE_URL; ?>/pricing.php" style="color: var(--text-light); transition: all 0.3s; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-chevron-left" style="font-size: 0.75rem;"></i> <?php echo t('nav_pricing'); ?>
                            </a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="<?php echo SITE_URL; ?>/contact.php" style="color: var(--text-light); transition: all 0.3s; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-chevron-left" style="font-size: 0.75rem;"></i> <?php echo t('nav_contact'); ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h4 style="font-size: 1.125rem; margin-bottom: 1rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan);">
                        <?php echo t('footer_services'); ?>
                    </h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.75rem;">
                            <span style="color: var(--text-light); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-check" style="color: var(--accent-purple);"></i> <?php echo t('service_ai_title'); ?>
                            </span>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <span style="color: var(--text-light); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-check" style="color: var(--accent-purple);"></i> <?php echo t('service_web_title'); ?>
                            </span>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <span style="color: var(--text-light); display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-check" style="color: var(--accent-purple);"></i> <?php echo t('service_marketing_title'); ?>
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 style="font-size: 1.125rem; margin-bottom: 1rem; color: var(--electric-cyan); text-shadow: var(--glow-cyan);">
                        <?php echo t('footer_contact'); ?>
                    </h4>
                    <ul style="list-style: none; padding: 0;">
                        <?php if (defined('CONTACT_EMAIL')): ?>
                            <li style="margin-bottom: 0.75rem;">
                                <a href="mailto:<?php echo CONTACT_EMAIL; ?>" style="color: var(--text-light); transition: all 0.3s; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-envelope" style="color: var(--accent-purple);"></i> <?php echo CONTACT_EMAIL; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (defined('CONTACT_PHONE')): ?>
                            <li style="margin-bottom: 0.75rem;">
                                <a href="tel:<?php echo CONTACT_PHONE; ?>" style="color: var(--text-light); transition: all 0.3s; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-phone" style="color: var(--accent-purple);"></i> <?php echo CONTACT_PHONE; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (defined('CONTACT_ADDRESS')): ?>
                            <li style="margin-bottom: 0.75rem;">
                                <span style="color: var(--text-light); display: flex; align-items: start; gap: 0.5rem;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--accent-purple); margin-top: 0.25rem;"></i> 
                                    <span><?php echo CONTACT_ADDRESS; ?></span>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div style="border-top: 1px solid rgba(124, 58, 237, 0.3); padding-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <p style="color: var(--text-light); margin: 0;">
                    &copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. <?php echo t('footer_rights'); ?>
                </p>
                <div style="display: flex; gap: 1.5rem;">
                    <a href="<?php echo SITE_URL; ?>/privacy.php" style="color: var(--text-light); transition: all 0.3s;">
                        <?php echo t('footer_privacy'); ?>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Analytics -->
    <?php if (file_exists(__DIR__ . '/analytics.php')): ?>
        <?php include __DIR__ . '/analytics.php'; ?>
    <?php endif; ?>

    <style>
        footer a:hover {
            color: var(--electric-cyan);
            text-shadow: var(--glow-cyan);
            transform: translateX(-3px);
        }

        footer .grid > div {
            padding: 1rem;
        }

        @media (max-width: 768px) {
            footer .grid {
                grid-template-columns: 1fr;
            }
            
            footer .grid > div {
                padding: 0.5rem 0;
            }
            
            footer > .container > div:first-child {
                margin-bottom: 2rem;
            }
        }
    </style>
</body>
</html>
