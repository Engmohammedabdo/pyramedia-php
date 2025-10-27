<?php
/**
 * Database Import Tool - Clean Version
 * This file should be DELETED after successful import for security reasons
 */

// Security: Require password
$IMPORT_PASSWORD = 'clean2025';

// Check if password is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted_password = $_POST['password'] ?? '';
    
    if ($submitted_password !== $IMPORT_PASSWORD) {
        die('Invalid password!');
    }
    
    // Include database configuration
    require_once '../db.php';
    $conn = get_db_connection();
    
    $results = [];
    $errors = [];
    
    try {
        // Step 1: TRUNCATE table to remove ALL existing data
        $conn->exec("TRUNCATE TABLE portfolio_items");
        $results[] = "✅ Cleared all existing portfolio items";
        
        // Step 2: Read and execute SQL file
        $sql_file = '../import_portfolio.sql';
        
        if (!file_exists($sql_file)) {
            throw new Exception("SQL file not found: $sql_file");
        }
        
        $sql_content = file_get_contents($sql_file);
        
        // Split by semicolon and execute each statement
        $statements = array_filter(
            array_map('trim', explode(';', $sql_content)),
            function($stmt) {
                return !empty($stmt) && 
                       !preg_match('/^--/', $stmt) && 
                       !preg_match('/^\/\*/', $stmt);
            }
        );
        
        foreach ($statements as $statement) {
            if (stripos($statement, 'INSERT INTO') === 0) {
                try {
                    $conn->exec($statement);
                    $results[] = "✅ " . substr($statement, 0, 100) . "...";
                } catch (PDOException $e) {
                    $errors[] = "❌ Error: " . $e->getMessage() . " | SQL: " . substr($statement, 0, 100);
                }
            }
        }
        
        // Step 3: Count total records
        $count = $conn->query("SELECT COUNT(*) FROM portfolio_items")->fetchColumn();
        $results[] = "✅ Total portfolio items in database: $count";
        
    } catch (Exception $e) {
        $errors[] = "❌ Fatal Error: " . $e->getMessage();
    }
    
    // Display results
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Import Results - Pyramedia</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body { background: #0f172a; color: #e2e8f0; font-family: 'Cairo', sans-serif; }
            .success { background: #065f46; border: 1px solid #10b981; }
            .error { background: #7f1d1d; border: 1px solid #ef4444; }
            .summary { background: #1e293b; border: 1px solid #334155; }
        </style>
    </head>
    <body class="p-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-center mb-8 text-yellow-400">📦 Database Import Results</h1>
            
            <!-- Summary -->
            <div class="summary rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold mb-4 text-center">📊 Summary</h2>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div class="bg-red-900/20 p-4 rounded">
                        <div class="text-4xl font-bold text-red-400"><?php echo count($errors); ?></div>
                        <div class="text-sm text-gray-400">Errors</div>
                    </div>
                    <div class="bg-green-900/20 p-4 rounded">
                        <div class="text-4xl font-bold text-green-400"><?php echo count($results); ?></div>
                        <div class="text-sm text-gray-400">Successful</div>
                    </div>
                </div>
            </div>
            
            <?php if (!empty($errors)): ?>
            <!-- Errors -->
            <div class="error rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">❌ Errors</h2>
                <div class="space-y-2 max-h-96 overflow-y-auto">
                    <?php foreach ($errors as $error): ?>
                        <div class="bg-black/30 p-3 rounded text-sm font-mono"><?php echo htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Success Results -->
            <div class="success rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">✅ Success Log</h2>
                <div class="space-y-2 max-h-96 overflow-y-auto">
                    <?php foreach ($results as $result): ?>
                        <div class="bg-black/30 p-3 rounded text-sm font-mono"><?php echo htmlspecialchars($result); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Warning -->
            <div class="bg-yellow-900/20 border border-yellow-600 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold mb-2 text-yellow-400">⚠️ Security Warning</h2>
                <p class="text-gray-300">Please delete this file (admin/import_db_clean.php) after successful import</p>
            </div>
            
            <!-- Actions -->
            <div class="flex gap-4 justify-center">
                <a href="portfolio.php" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg font-bold transition">
                    Go to Admin Dashboard
                </a>
                <a href="../portfolio.php" class="bg-yellow-600 hover:bg-yellow-700 px-6 py-3 rounded-lg font-bold transition">
                    View Portfolio Page
                </a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Import - Pyramedia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>
<body>
    <div class="bg-slate-800 rounded-2xl p-8 shadow-2xl max-w-md w-full mx-4">
        <!-- Icon -->
        <div class="text-center mb-6">
            <div class="inline-block bg-yellow-500 rounded-full p-4 mb-4">
                <svg class="w-12 h-12 text-slate-900" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"/>
                    <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"/>
                    <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-yellow-400">Database Import - Clean</h1>
            <p class="text-gray-400 mt-2">This will DELETE all existing data and import fresh data</p>
        </div>
        
        <!-- Form -->
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required
                    placeholder="Enter import password"
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                >
            </div>
            
            <button 
                type="submit"
                class="w-full bg-yellow-500 hover:bg-yellow-600 text-slate-900 font-bold py-3 rounded-lg transition duration-200"
            >
                🗑️ Clear & Import Data
            </button>
            
            <div class="bg-slate-700 rounded-lg p-4 text-sm text-gray-300">
                <strong>Password:</strong> clean2025
            </div>
            
            <div class="bg-red-900/20 border border-red-600 rounded-lg p-4 text-sm text-red-300">
                <strong>⚠️ Warning:</strong> This will DELETE all existing portfolio data!
            </div>
        </form>
        
        <!-- Back Link -->
        <div class="text-center mt-6">
            <a href="index.php" class="text-pink-400 hover:text-pink-300 text-sm">
                ← Back to Admin Dashboard
            </a>
        </div>
    </div>
</body>
</html>

