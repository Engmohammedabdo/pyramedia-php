<?php
/**
 * Pyramedia Website Configuration
 */

// Site Information
define('SITE_NAME', 'Pyramedia');
define('SITE_TITLE', 'Pyramedia - AI-Powered Digital Marketing');
define('SITE_DESCRIPTION', 'Transform your ideas into digital success with AI-powered marketing solutions. 500+ successful projects in digital marketing, design, and social media management.');
define('SITE_KEYWORDS', 'digital marketing, AI marketing, graphic design, social media, UAE, تسويق إلكتروني, ذكاء اصطناعي');

// Brand Colors (CSS Variables)
define('COLOR_BG', '#0b0b0c');        // Deep black
define('COLOR_FG', '#ffffff');        // White
define('COLOR_ACCENT', '#d4af37');    // Gold
define('COLOR_MUTED', '#9aa0a6');     // Muted gray

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
    // Try to get from database first
    require_once __DIR__ . '/db.php';
    
    try {
        $items = db_fetch_all("SELECT * FROM portfolio_items ORDER BY order_index ASC, created_at DESC");
        
        if (!empty($items)) {
            // Convert database format to expected format
            $portfolio = [];
            foreach ($items as $item) {
                $portfolio[] = [
                    'id' => $item['id'],
                    'project_title' => $item['title'],
                    'client_name' => $item['client'],
                    'category' => $item['category'],
                    'description' => $item['description'],
                    'image' => $item['image'],
                    'services' => $item['services'],
                    'duration' => $item['duration'],
                    'year' => $item['year']
                ];
            }
            return $portfolio;
        }
    } catch (Exception $e) {
        // Fall back to JSON if database fails
        error_log("Portfolio DB error: " . $e->getMessage());
    }
    
    // Fallback to JSON file
    $json_file = __DIR__ . '/pyramedia-portfolio.json';
    if (file_exists($json_file)) {
        $json = file_get_contents($json_file);
        $data = json_decode($json, true);
        
        // Convert JSON format to expected format
        $portfolio = [];
        foreach ($data as $item) {
            $portfolio[] = [
                'id' => $item['id'],
                'project_title' => $item['title'],
                'client_name' => $item['client'],
                'category' => $item['category'],
                'description' => $item['description'],
                'image' => $item['image'],
                'services' => implode(', ', $item['tags'] ?? []),
                'duration' => $item['duration'] ?? '',
                'year' => null
            ];
        }
        return $portfolio;
    }
    
    // Last fallback: old portfolio.json
    $old_json = __DIR__ . '/portfolio.json';
    if (file_exists($old_json)) {
        $json = file_get_contents($old_json);
        return json_decode($json, true);
    }
    
    return [];
}

function get_current_page() {
    $page = basename($_SERVER['PHP_SELF'], '.php');
    return $page === 'index' ? 'home' : $page;
}

function get_lang() {
    return $_SESSION['lang'] ?? 'ar';
}

function set_lang($lang) {
    $_SESSION['lang'] = $lang;
}

function t($key, $lang = null) {
    $lang = $lang ?? get_lang();
    static $translations = [];
    
    if (!isset($translations[$lang])) {
        $file = __DIR__ . "/lang/{$lang}.json";
        if (file_exists($file)) {
            $translations[$lang] = json_decode(file_get_contents($file), true);
        } else {
            $translations[$lang] = [];
        }
    }
    
    return $translations[$lang][$key] ?? $key;
}
?>
