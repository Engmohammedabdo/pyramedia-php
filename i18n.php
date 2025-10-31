<?php
/**
 * Internationalization (i18n) System
 * Supports Arabic and English
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Default language
define('DEFAULT_LANG', 'ar');
define('SUPPORTED_LANGS', ['ar', 'en']);

// Get current language
function get_current_lang() {
    // Check if language is set in session
    if (isset($_SESSION['lang']) && in_array($_SESSION['lang'], SUPPORTED_LANGS)) {
        return $_SESSION['lang'];
    }
    
    // Check if language is set in cookie
    if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], SUPPORTED_LANGS)) {
        $_SESSION['lang'] = $_COOKIE['lang'];
        return $_COOKIE['lang'];
    }
    
    // Check browser language
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if (in_array($browser_lang, SUPPORTED_LANGS)) {
            $_SESSION['lang'] = $browser_lang;
            return $browser_lang;
        }
    }
    
    // Return default
    $_SESSION['lang'] = DEFAULT_LANG;
    return DEFAULT_LANG;
}

// Set language
function set_lang($lang) {
    if (in_array($lang, SUPPORTED_LANGS)) {
        $_SESSION['lang'] = $lang;
        setcookie('lang', $lang, time() + (86400 * 365), '/'); // 1 year
        return true;
    }
    return false;
}

// Load language file
$current_lang = get_current_lang();
$lang_file = __DIR__ . '/lang/' . $current_lang . '.php';

if (file_exists($lang_file)) {
    $translations = require $lang_file;
} else {
    // Fallback to default language
    $translations = require __DIR__ . '/lang/' . DEFAULT_LANG . '.php';
}

// Translation function
function t($key, $default = null) {
    global $translations;
    
    // Support nested keys (e.g., 'nav.home')
    $keys = explode('.', $key);
    $value = $translations;
    
    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $default ?? $key;
        }
    }
    
    return $value;
}

// Get language direction
function lang_dir() {
    global $current_lang;
    return $current_lang === 'ar' ? 'rtl' : 'ltr';
}

// Get language code for HTML
function lang_code() {
    global $current_lang;
    return $current_lang;
}

// Check if current language is RTL
function is_rtl() {
    return lang_dir() === 'rtl';
}

// Get opposite language
function get_other_lang() {
    global $current_lang;
    return $current_lang === 'ar' ? 'en' : 'ar';
}

// Get language name
function get_lang_name($lang = null) {
    $lang = $lang ?? get_current_lang();
    $names = [
        'ar' => 'العربية',
        'en' => 'English'
    ];
    return $names[$lang] ?? $lang;
}
?>
