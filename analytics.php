<?php
/**
 * Analytics & SEO Tracking
 */

// Google Analytics 4 (GA4)
function render_google_analytics($measurement_id = null) {
    // Get from settings or use default
    $ga_id = $measurement_id ?? get_setting('google_analytics_id');
    
    if (empty($ga_id)) {
        return;
    }
    ?>
    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars($ga_id); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo htmlspecialchars($ga_id); ?>', {
            'anonymize_ip': true,
            'cookie_flags': 'SameSite=None;Secure'
        });
    </script>
    <?php
}

// Google Tag Manager (GTM)
function render_google_tag_manager($gtm_id = null) {
    $gtm = $gtm_id ?? get_setting('google_tag_manager_id');
    
    if (empty($gtm)) {
        return;
    }
    ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo htmlspecialchars($gtm); ?>');</script>
    <!-- End Google Tag Manager -->
    <?php
}

// Google Tag Manager (noscript)
function render_google_tag_manager_noscript($gtm_id = null) {
    $gtm = $gtm_id ?? get_setting('google_tag_manager_id');
    
    if (empty($gtm)) {
        return;
    }
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo htmlspecialchars($gtm); ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}

// Facebook Pixel
function render_facebook_pixel($pixel_id = null) {
    $fb_pixel = $pixel_id ?? get_setting('facebook_pixel_id');
    
    if (empty($fb_pixel)) {
        return;
    }
    ?>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php echo htmlspecialchars($fb_pixel); ?>');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=<?php echo htmlspecialchars($fb_pixel); ?>&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <?php
}

// Get setting from database or config
function get_setting($key, $default = null) {
    // Try to get from database first
    if (function_exists('db_fetch_one')) {
        try {
            $result = db_fetch_one("SELECT setting_value FROM site_settings WHERE setting_key = :key", [':key' => $key]);
            if ($result) {
                return $result['setting_value'];
            }
        } catch (Exception $e) {
            // Database not available, continue to default
        }
    }
    
    // Return default
    return $default;
}

// Track custom event
function track_event($event_name, $params = []) {
    ?>
    <script>
    if (typeof gtag !== 'undefined') {
        gtag('event', '<?php echo htmlspecialchars($event_name); ?>', <?php echo json_encode($params); ?>);
    }
    if (typeof fbq !== 'undefined') {
        fbq('track', '<?php echo htmlspecialchars($event_name); ?>', <?php echo json_encode($params); ?>);
    }
    </script>
    <?php
}
?>
