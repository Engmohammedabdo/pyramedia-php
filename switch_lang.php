<?php
/**
 * Language Switcher
 */

require_once 'i18n.php';

// Get requested language
$requested_lang = $_GET['lang'] ?? null;

// Set language if valid
if ($requested_lang && set_lang($requested_lang)) {
    // Get redirect URL
    $redirect = $_GET['redirect'] ?? $_SERVER['HTTP_REFERER'] ?? '/';
    
    // Redirect back
    header('Location: ' . $redirect);
    exit;
}

// Invalid request
header('Location: /');
exit;
?>
