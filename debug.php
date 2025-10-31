<?php
// Enable all error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Debug Report</title>";
echo "<style>body{font-family:monospace;background:#1a0b2e;color:#e0e7ff;padding:2rem;}";
echo ".success{color:#10b981;}.error{color:#ef4444;}.warning{color:#f59e0b;}";
echo "h2{color:#00d4ff;border-bottom:2px solid #7c3aed;padding-bottom:0.5rem;}</style></head><body>";

echo "<h1>🔍 Pyramedia Debug Report</h1>";
echo "<p>Generated: " . date('Y-m-d H:i:s') . "</p><hr>";

// Test 1: PHP Version
echo "<h2>1. PHP Environment</h2>";
echo "<p>PHP Version: <span class='success'>" . phpversion() . "</span></p>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";

// Test 2: File Existence
echo "<h2>2. Required Files</h2>";
$files = ['config.php', 'db.php', 'i18n.php', 'header.php', 'footer.php', 'assets/css/gradient-mesh.css'];
foreach ($files as $file) {
    $exists = file_exists($file);
    $class = $exists ? 'success' : 'error';
    $icon = $exists ? '✓' : '✗';
    echo "<p class='$class'>$icon $file</p>";
}

// Test 3: Try to include files
echo "<h2>3. File Inclusion Test</h2>";

try {
    require_once 'config.php';
    echo "<p class='success'>✓ config.php loaded</p>";
} catch (Exception $e) {
    echo "<p class='error'>✗ config.php failed: " . $e->getMessage() . "</p>";
}

try {
    require_once 'db.php';
    echo "<p class='success'>✓ db.php loaded</p>";
} catch (Exception $e) {
    echo "<p class='error'>✗ db.php failed: " . $e->getMessage() . "</p>";
}

try {
    require_once 'i18n.php';
    echo "<p class='success'>✓ i18n.php loaded</p>";
} catch (Exception $e) {
    echo "<p class='error'>✗ i18n.php failed: " . $e->getMessage() . "</p>";
}

// Test 4: Check functions
echo "<h2>4. Required Functions</h2>";
$functions = ['get_lang', 'set_lang', 't', 'get_portfolio_data'];
foreach ($functions as $func) {
    $exists = function_exists($func);
    $class = $exists ? 'success' : 'error';
    $icon = $exists ? '✓' : '✗';
    echo "<p class='$class'>$icon $func()</p>";
}

// Test 5: Check constants
echo "<h2>5. Required Constants</h2>";
$constants = ['SITE_NAME', 'SITE_URL', 'CONTACT_EMAIL'];
foreach ($constants as $const) {
    $exists = defined($const);
    $class = $exists ? 'success' : 'warning';
    $icon = $exists ? '✓' : '!';
    $value = $exists ? constant($const) : 'Not defined';
    echo "<p class='$class'>$icon $const = $value</p>";
}

// Test 6: Database connection
echo "<h2>6. Database Connection</h2>";
try {
    if (isset($pdo) && $pdo) {
        echo "<p class='success'>✓ Database connected</p>";
        
        // Try to count portfolio items
        $stmt = $pdo->query("SELECT COUNT(*) FROM portfolio_items");
        $count = $stmt->fetchColumn();
        echo "<p class='success'>✓ Portfolio items: $count</p>";
    } else {
        echo "<p class='warning'>! Database not connected (using JSON fallback)</p>";
    }
} catch (Exception $e) {
    echo "<p class='warning'>! Database error: " . $e->getMessage() . "</p>";
}

// Test 7: Try to simulate index.php
echo "<h2>7. Simulate index.php</h2>";
try {
    $page_title = t('home_title') . ' | ' . SITE_NAME;
    echo "<p class='success'>✓ Page title: $page_title</p>";
    
    $featured_projects = get_portfolio_data(6);
    echo "<p class='success'>✓ Featured projects: " . count($featured_projects) . "</p>";
    
    echo "<p class='success'>✓ index.php simulation successful!</p>";
} catch (Exception $e) {
    echo "<p class='error'>✗ index.php simulation failed: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

// Test 8: Memory and limits
echo "<h2>8. PHP Limits</h2>";
echo "<p>Memory Limit: " . ini_get('memory_limit') . "</p>";
echo "<p>Max Execution Time: " . ini_get('max_execution_time') . "s</p>";
echo "<p>Upload Max Filesize: " . ini_get('upload_max_filesize') . "</p>";

echo "<hr><p style='color:#10b981;'>Debug report completed successfully!</p>";
echo "<p><a href='index.php' style='color:#00d4ff;'>← Try index.php</a></p>";
echo "</body></html>";
?>
