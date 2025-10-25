<?php
/**
 * Pyramedia Website Configuration
 */

// Site Information
define('SITE_NAME', 'Pyramedia');
define('SITE_TITLE', 'Pyramedia - AI-Powered Digital Marketing');
define('SITE_DESCRIPTION', 'Transform your ideas into digital success with AI-powered marketing solutions. 500+ successful projects in digital marketing, design, and social media management.');
define('SITE_KEYWORDS', 'digital marketing, AI marketing, graphic design, social media, UAE, تسويق إلكتروني, ذكاء اصطناعي');

// Contact Information
define('CONTACT_EMAIL', 'info@pyramedia.ae');
define('CONTACT_PHONE', '+971 XX XXX XXXX');
define('CONTACT_ADDRESS', 'United Arab Emirates');

// Social Media
define('SOCIAL_FACEBOOK', '#');
define('SOCIAL_INSTAGRAM', '#');
define('SOCIAL_TWITTER', '#');
define('SOCIAL_LINKEDIN', '#');

// Stats
define('STAT_PROJECTS', '500+');
define('STAT_CLIENTS', '200+');
define('STAT_EXPERIENCE', '15+');
define('STAT_SATISFACTION', '99%');

// Helper Functions
function asset($path) {
    return '/' . ltrim($path, '/');
}

function url($path = '') {
    return '/' . ltrim($path, '/');
}

function get_portfolio_data() {
    $json = file_get_contents(__DIR__ . '/portfolio.json');
    return json_decode($json, true);
}

function get_current_page() {
    $page = basename($_SERVER['PHP_SELF'], '.php');
    return $page === 'index' ? 'home' : $page;
}
?>

