<?php
/**
 * Database Import Script
 * This script imports portfolio data from import_portfolio.sql
 * 
 * SECURITY: Delete this file after use!
 */

require_once __DIR__ . '/../db.php';

// Simple password protection
$correct_password = 'import2025';
$entered_password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $entered_password === $correct_password) {
    $sql_file = __DIR__ . '/../import_portfolio.sql';
    
    if (!file_exists($sql_file)) {
        die("❌ Error: import_portfolio.sql not found!");
    }
    
    $sql_content = file_get_contents($sql_file);
    
    // Split SQL into individual statements
    $statements = array_filter(
        array_map('trim', explode(';', $sql_content)),
        function($stmt) {
            return !empty($stmt) && !preg_match('/^--/', $stmt);
        }
    );
    
    echo "<!DOCTYPE html>
<html lang='ar' dir='rtl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Database Import - Pyramedia</title>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body class='bg-gray-900 text-white p-8'>
    <div class='max-w-4xl mx-auto'>
        <h1 class='text-3xl font-bold mb-6 text-yellow-400'>📦 Database Import Results</h1>
        <div class='space-y-4'>";
    
    $success_count = 0;
    $error_count = 0;
    
    foreach ($statements as $index => $statement) {
        try {
            db_query($statement);
            $success_count++;
            
            // Show only important statements
            if (stripos($statement, 'TRUNCATE') !== false || $index < 3 || $index > count($statements) - 3) {
                $preview = substr($statement, 0, 100) . (strlen($statement) > 100 ? '...' : '');
                echo "<div class='bg-green-900/30 border border-green-500 rounded p-4'>
                        <div class='flex items-start gap-3'>
                            <span class='text-green-400 text-xl'>✅</span>
                            <div class='flex-1'>
                                <p class='text-sm text-gray-400 font-mono'>" . htmlspecialchars($preview) . "</p>
                            </div>
                        </div>
                      </div>";
            }
        } catch (Exception $e) {
            $error_count++;
            $preview = substr($statement, 0, 100) . (strlen($statement) > 100 ? '...' : '');
            echo "<div class='bg-red-900/30 border border-red-500 rounded p-4'>
                    <div class='flex items-start gap-3'>
                        <span class='text-red-400 text-xl'>❌</span>
                        <div class='flex-1'>
                            <p class='text-sm text-gray-400 font-mono mb-2'>" . htmlspecialchars($preview) . "</p>
                            <p class='text-red-300 text-sm'>" . htmlspecialchars($e->getMessage()) . "</p>
                        </div>
                    </div>
                  </div>";
        }
    }
    
    echo "</div>
        <div class='mt-8 p-6 bg-gray-800 rounded-lg'>
            <h2 class='text-2xl font-bold mb-4'>📊 Summary</h2>
            <div class='grid grid-cols-2 gap-4'>
                <div class='bg-green-900/30 p-4 rounded'>
                    <p class='text-green-400 text-3xl font-bold'>{$success_count}</p>
                    <p class='text-gray-400'>Successful</p>
                </div>
                <div class='bg-red-900/30 p-4 rounded'>
                    <p class='text-red-400 text-3xl font-bold'>{$error_count}</p>
                    <p class='text-gray-400'>Errors</p>
                </div>
            </div>
        </div>
        
        <div class='mt-6 p-4 bg-yellow-900/30 border border-yellow-500 rounded'>
            <p class='text-yellow-400 font-bold'>⚠️ Security Warning</p>
            <p class='text-gray-300 mt-2'>Please delete this file (admin/import_db.php) after successful import!</p>
        </div>
        
        <div class='mt-6 flex gap-4'>
            <a href='index.php' class='bg-yellow-600 hover:bg-yellow-700 px-6 py-3 rounded font-semibold'>
                Go to Admin Dashboard
            </a>
            <a href='../portfolio.php' class='bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded font-semibold'>
                View Portfolio Page
            </a>
        </div>
    </div>
</body>
</html>";
    
} else {
    // Show password form
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Database Import - Pyramedia</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-900 text-white min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <div class="bg-gray-800 rounded-lg p-8 border border-gray-700">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">📦</span>
                    </div>
                    <h1 class="text-2xl font-bold text-yellow-400">Database Import</h1>
                    <p class="text-gray-400 mt-2">Import portfolio data from SQL file</p>
                </div>
                
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <div class="bg-red-900/30 border border-red-500 rounded p-4 mb-6">
                        <p class="text-red-300">❌ Incorrect password</p>
                    </div>
                <?php endif; ?>
                
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-gray-300 mb-2">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-3 text-white focus:outline-none focus:border-yellow-500"
                            placeholder="Enter import password"
                            required
                            autofocus
                        >
                    </div>
                    
                    <button 
                        type="submit"
                        class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-3 rounded transition-colors"
                    >
                        Import Data
                    </button>
                </form>
                
                <div class="mt-6 p-4 bg-blue-900/30 border border-blue-500 rounded">
                    <p class="text-blue-300 text-sm">
                        <strong>Password:</strong> import2025
                    </p>
                </div>
                
                <div class="mt-4 text-center">
                    <a href="index.php" class="text-gray-400 hover:text-white text-sm">
                        ← Back to Admin Dashboard
                    </a>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>

