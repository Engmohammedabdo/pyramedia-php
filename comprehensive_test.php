<?php
/**
 * Comprehensive Test Suite for Pyramedia
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html>
<html lang='ar' dir='rtl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Pyramedia - اختبار شامل</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { background: white; border-radius: 12px; padding: 30px; margin-bottom: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
        h1 { color: #667eea; margin-bottom: 10px; font-size: 32px; }
        h2 { color: #764ba2; margin: 20px 0 15px; font-size: 24px; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
        h3 { color: #555; margin: 15px 0 10px; font-size: 18px; }
        .success { color: #10b981; font-weight: bold; }
        .error { color: #ef4444; font-weight: bold; }
        .warning { color: #f59e0b; font-weight: bold; }
        .info { color: #3b82f6; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; margin-left: 10px; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-error { background: #fee2e2; color: #991b1b; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 12px; text-align: right; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; color: #374151; }
        tr:hover { background: #f9fafb; }
        .stat { display: inline-block; margin: 10px 20px 10px 0; }
        .stat-value { font-size: 28px; font-weight: bold; color: #667eea; }
        .stat-label { font-size: 14px; color: #6b7280; margin-top: 5px; }
        pre { background: #f3f4f6; padding: 15px; border-radius: 8px; overflow-x: auto; margin: 10px 0; }
        code { font-family: 'Courier New', monospace; font-size: 13px; }
    </style>
</head>
<body>
<div class='container'>
    <div class='card'>
        <h1>🚀 Pyramedia - اختبار شامل</h1>
        <p class='info'>فحص شامل لجميع مكونات الموقع</p>
    </div>";

$results = [
    'total' => 0,
    'passed' => 0,
    'failed' => 0,
    'warnings' => 0
];

// Test 1: PHP Version
echo "<div class='card'><h2>1. بيئة PHP</h2>";
$php_version = phpversion();
echo "<p><strong>إصدار PHP:</strong> $php_version ";
if (version_compare($php_version, '7.4', '>=')) {
    echo "<span class='badge badge-success'>✓ متوافق</span></p>";
    $results['passed']++;
} else {
    echo "<span class='badge badge-error'>✗ قديم</span></p>";
    $results['failed']++;
}
$results['total']++;

// Required extensions
$required_extensions = ['pdo', 'pdo_mysql', 'mbstring', 'json', 'session'];
echo "<h3>الامتدادات المطلوبة:</h3><table><tr><th>الامتداد</th><th>الحالة</th></tr>";
foreach ($required_extensions as $ext) {
    $results['total']++;
    echo "<tr><td>$ext</td><td>";
    if (extension_loaded($ext)) {
        echo "<span class='success'>✓ مثبت</span>";
        $results['passed']++;
    } else {
        echo "<span class='error'>✗ غير مثبت</span>";
        $results['failed']++;
    }
    echo "</td></tr>";
}
echo "</table></div>";

// Test 2: Core Files
echo "<div class='card'><h2>2. الملفات الأساسية</h2>";
$core_files = [
    'config.php' => 'ملف الإعدادات',
    'db.php' => 'قاعدة البيانات',
    'i18n.php' => 'نظام الترجمة',
    'schema.php' => 'مخطط قاعدة البيانات',
    'header.php' => 'الهيدر',
    'footer.php' => 'الفوتر'
];

echo "<table><tr><th>الملف</th><th>الوصف</th><th>الحالة</th></tr>";
foreach ($core_files as $file => $desc) {
    $results['total']++;
    echo "<tr><td>$file</td><td>$desc</td><td>";
    if (file_exists(__DIR__ . "/$file")) {
        echo "<span class='success'>✓ موجود</span>";
        $results['passed']++;
        
        // Check if loadable
        try {
            include_once __DIR__ . "/$file";
        } catch (Exception $e) {
            echo " <span class='warning'>⚠ خطأ في التحميل</span>";
            $results['warnings']++;
        }
    } else {
        echo "<span class='error'>✗ مفقود</span>";
        $results['failed']++;
    }
    echo "</td></tr>";
}
echo "</table></div>";

// Test 3: Database Connection
echo "<div class='card'><h2>3. قاعدة البيانات</h2>";
$results['total']++;
try {
    require_once __DIR__ . '/db.php';
    $conn = get_db_connection();
    echo "<p class='success'>✓ الاتصال بقاعدة البيانات ناجح</p>";
    $results['passed']++;
    
    // Check tables
    $tables = ['portfolio_items', 'contact_messages', 'site_settings'];
    echo "<h3>الجداول:</h3><table><tr><th>الجدول</th><th>عدد السجلات</th></tr>";
    foreach ($tables as $table) {
        $results['total']++;
        try {
            $count = db_count($table);
            echo "<tr><td>$table</td><td class='success'>$count سجل</td></tr>";
            $results['passed']++;
        } catch (Exception $e) {
            echo "<tr><td>$table</td><td class='error'>غير موجود</td></tr>";
            $results['failed']++;
        }
    }
    echo "</table>";
} catch (Exception $e) {
    echo "<p class='error'>✗ فشل الاتصال: " . $e->getMessage() . "</p>";
    $results['failed']++;
}
echo "</div>";

// Test 4: Pages
echo "<div class='card'><h2>4. صفحات الموقع</h2>";
$pages = [
    'index.php' => 'الصفحة الرئيسية',
    'portfolio.php' => 'معرض الأعمال',
    'services.php' => 'الخدمات',
    'pricing.php' => 'الأسعار',
    'case-studies.php' => 'دراسات الحالة',
    'contact.php' => 'التواصل',
    'privacy.php' => 'سياسة الخصوصية'
];

echo "<table><tr><th>الصفحة</th><th>الوصف</th><th>الحالة</th><th>الحجم</th></tr>";
foreach ($pages as $page => $desc) {
    $results['total']++;
    echo "<tr><td>$page</td><td>$desc</td><td>";
    if (file_exists(__DIR__ . "/$page")) {
        $size = filesize(__DIR__ . "/$page");
        $size_kb = round($size / 1024, 1);
        echo "<span class='success'>✓ موجود</span></td><td>{$size_kb} KB</td></tr>";
        $results['passed']++;
    } else {
        echo "<span class='error'>✗ مفقود</span></td><td>-</td></tr>";
        $results['failed']++;
    }
}
echo "</table></div>";

// Test 5: Admin Panel
echo "<div class='card'><h2>5. لوحة التحكم</h2>";
$admin_files = [
    'admin/index.php' => 'Dashboard',
    'admin/portfolio.php' => 'إدارة المشاريع',
    'admin/messages.php' => 'إدارة الرسائل',
    'admin/settings.php' => 'الإعدادات',
    'admin/login.php' => 'تسجيل الدخول'
];

echo "<table><tr><th>الملف</th><th>الوصف</th><th>الحالة</th></tr>";
foreach ($admin_files as $file => $desc) {
    $results['total']++;
    echo "<tr><td>$file</td><td>$desc</td><td>";
    if (file_exists(__DIR__ . "/$file")) {
        echo "<span class='success'>✓ موجود</span>";
        $results['passed']++;
    } else {
        echo "<span class='error'>✗ مفقود</span>";
        $results['failed']++;
    }
    echo "</td></tr>";
}
echo "</table></div>";

// Test 6: Language Files
echo "<div class='card'><h2>6. ملفات اللغات</h2>";
$lang_files = ['lang/ar.php', 'lang/en.php'];
echo "<table><tr><th>الملف</th><th>الحالة</th><th>عدد الترجمات</th></tr>";
foreach ($lang_files as $file) {
    $results['total']++;
    echo "<tr><td>$file</td><td>";
    if (file_exists(__DIR__ . "/$file")) {
        echo "<span class='success'>✓ موجود</span></td><td>";
        $translations = include __DIR__ . "/$file";
        echo count($translations) . " ترجمة";
        $results['passed']++;
    } else {
        echo "<span class='error'>✗ مفقود</span></td><td>-";
        $results['failed']++;
    }
    echo "</td></tr>";
}
echo "</table></div>";

// Summary
$pass_rate = $results['total'] > 0 ? round(($results['passed'] / $results['total']) * 100) : 0;
echo "<div class='card'>
    <h2>📊 الملخص النهائي</h2>
    <div style='text-align: center; margin: 30px 0;'>
        <div class='stat'>
            <div class='stat-value'>{$results['total']}</div>
            <div class='stat-label'>إجمالي الاختبارات</div>
        </div>
        <div class='stat'>
            <div class='stat-value' style='color: #10b981;'>{$results['passed']}</div>
            <div class='stat-label'>نجح</div>
        </div>
        <div class='stat'>
            <div class='stat-value' style='color: #ef4444;'>{$results['failed']}</div>
            <div class='stat-label'>فشل</div>
        </div>
        <div class='stat'>
            <div class='stat-value' style='color: #f59e0b;'>{$results['warnings']}</div>
            <div class='stat-label'>تحذيرات</div>
        </div>
        <div class='stat'>
            <div class='stat-value'>{$pass_rate}%</div>
            <div class='stat-label'>نسبة النجاح</div>
        </div>
    </div>";

if ($results['failed'] == 0 && $results['warnings'] == 0) {
    echo "<div style='background: #d1fae5; color: #065f46; padding: 20px; border-radius: 8px; text-align: center; font-size: 18px; font-weight: bold;'>
        ✓ جميع الاختبارات نجحت! المشروع جاهز للنشر 🚀
    </div>";
} elseif ($results['failed'] == 0) {
    echo "<div style='background: #fef3c7; color: #92400e; padding: 20px; border-radius: 8px; text-align: center; font-size: 18px; font-weight: bold;'>
        ⚠ لا توجد أخطاء حرجة، لكن يرجى مراجعة التحذيرات
    </div>";
} else {
    echo "<div style='background: #fee2e2; color: #991b1b; padding: 20px; border-radius: 8px; text-align: center; font-size: 18px; font-weight: bold;'>
        ✗ يرجى إصلاح الأخطاء قبل النشر
    </div>";
}

echo "</div>";

echo "<div class='card' style='text-align: center; color: #6b7280; font-size: 14px;'>
    <p>تم الاختبار في: " . date('Y-m-d H:i:s') . "</p>
    <p>Pyramedia © 2024</p>
</div>";

echo "</div></body></html>";
?>
