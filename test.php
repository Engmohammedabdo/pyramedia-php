<?php
/**
 * PHP Test File
 * Access: https://gpt.pyramedia.info/test.php
 */

// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>PHP Test</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";

// Test config.php
echo "<h2>Testing config.php</h2>";
try {
    require_once 'config.php';
    echo "<p style='color: green;'>✓ config.php loaded successfully</p>";
    echo "<p>SITE_NAME: " . SITE_NAME . "</p>";
    echo "<p>SITE_URL: " . SITE_URL . "</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error loading config.php: " . $e->getMessage() . "</p>";
}

// Test db.php
echo "<h2>Testing db.php</h2>";
try {
    require_once 'db.php';
    echo "<p style='color: green;'>✓ db.php loaded successfully</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error loading db.php: " . $e->getMessage() . "</p>";
}

// Test i18n.php
echo "<h2>Testing i18n.php</h2>";
try {
    require_once 'i18n.php';
    echo "<p style='color: green;'>✓ i18n.php loaded successfully</p>";
    echo "<p>Current Language: " . get_current_lang() . "</p>";
    echo "<p>Language Direction: " . lang_dir() . "</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error loading i18n.php: " . $e->getMessage() . "</p>";
}

// Test schema.php
echo "<h2>Testing schema.php</h2>";
try {
    require_once 'schema.php';
    echo "<p style='color: green;'>✓ schema.php loaded successfully</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error loading schema.php: " . $e->getMessage() . "</p>";
}

// Test database connection
echo "<h2>Testing Database Connection</h2>";
try {
    $pdo = get_db_connection();
    if ($pdo) {
        echo "<p style='color: green;'>✓ Database connected successfully</p>";
        
        // Test portfolio_items table
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM portfolio_items");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p>Portfolio Items Count: " . $result['count'] . "</p>";
    } else {
        echo "<p style='color: orange;'>⚠ Database not connected (using JSON fallback)</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database error: " . $e->getMessage() . "</p>";
}

echo "<h2>PHP Info</h2>";
echo "<p><a href='?phpinfo=1'>View PHP Info</a></p>";

if (isset($_GET['phpinfo'])) {
    phpinfo();
}
?>
