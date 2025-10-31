<?php
/**
 * Pages Testing Script
 * 
 * هذا السكريبت يقوم باختبار جميع صفحات الموقع للتأكد من عدم وجود أخطاء
 */

echo "=== اختبار شامل لصفحات الموقع ===" . PHP_EOL . PHP_EOL;

// قائمة الصفحات للاختبار
$pages = [
    'index.php' => 'الصفحة الرئيسية',
    'portfolio.php' => 'معرض الأعمال',
    'services.php' => 'الخدمات',
    'pricing.php' => 'الأسعار',
    'case-studies.php' => 'دراسات الحالة',
    'contact.php' => 'التواصل',
    'privacy.php' => 'سياسة الخصوصية'
];

$passed = 0;
$failed = 0;
$errors = [];

foreach ($pages as $file => $name) {
    echo "اختبار: $name ($file)..." . PHP_EOL;
    
    if (!file_exists(__DIR__ . '/' . $file)) {
        echo "   ✗ الملف غير موجود!" . PHP_EOL . PHP_EOL;
        $failed++;
        $errors[] = "$name: الملف غير موجود";
        continue;
    }
    
    // محاولة تنفيذ الصفحة والتقاط الأخطاء
    ob_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    try {
        // تعيين متغيرات SERVER اللازمة
        $_SERVER['PHP_SELF'] = '/' . $file;
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['REQUEST_URI'] = '/' . $file;
        
        // تضمين الملف
        include __DIR__ . '/' . $file;
        
        $output = ob_get_clean();
        
        // فحص وجود أخطاء في المخرجات
        if (stripos($output, 'fatal error') !== false || 
            stripos($output, 'parse error') !== false || 
            stripos($output, 'warning') !== false) {
            
            echo "   ✗ تم اكتشاف أخطاء في المخرجات" . PHP_EOL;
            
            // استخراج سطور الأخطاء
            $lines = explode("\n", $output);
            foreach ($lines as $line) {
                if (stripos($line, 'error') !== false || stripos($line, 'warning') !== false) {
                    echo "      " . trim($line) . PHP_EOL;
                    $errors[] = "$name: " . trim($line);
                }
            }
            echo PHP_EOL;
            $failed++;
        } else {
            echo "   ✓ الصفحة تعمل بشكل صحيح" . PHP_EOL;
            echo "   حجم المخرجات: " . strlen($output) . " بايت" . PHP_EOL . PHP_EOL;
            $passed++;
        }
        
    } catch (Exception $e) {
        ob_end_clean();
        echo "   ✗ خطأ: " . $e->getMessage() . PHP_EOL . PHP_EOL;
        $failed++;
        $errors[] = "$name: " . $e->getMessage();
    } catch (Error $e) {
        ob_end_clean();
        echo "   ✗ خطأ فادح: " . $e->getMessage() . PHP_EOL;
        echo "      في الملف: " . $e->getFile() . " السطر: " . $e->getLine() . PHP_EOL . PHP_EOL;
        $failed++;
        $errors[] = "$name: " . $e->getMessage() . " (السطر " . $e->getLine() . ")";
    }
}

// ملخص الاختبار
echo "=== ملخص الاختبار ===" . PHP_EOL . PHP_EOL;
echo "إجمالي الصفحات: " . count($pages) . PHP_EOL;
echo "نجحت: $passed" . PHP_EOL;
echo "فشلت: $failed" . PHP_EOL . PHP_EOL;

if (!empty($errors)) {
    echo "=== الأخطاء المكتشفة ===" . PHP_EOL . PHP_EOL;
    foreach ($errors as $i => $error) {
        echo ($i + 1) . ". $error" . PHP_EOL;
    }
    echo PHP_EOL;
}

if ($failed === 0) {
    echo "✓ جميع الصفحات تعمل بشكل صحيح!" . PHP_EOL;
} else {
    echo "✗ يوجد $failed صفحة/صفحات تحتاج إلى إصلاح" . PHP_EOL;
}

// اختبار إضافي: التحقق من البيانات
echo PHP_EOL . "=== اختبار البيانات ===" . PHP_EOL . PHP_EOL;

require_once __DIR__ . '/config.php';

echo "1. اختبار دالة get_portfolio_data()..." . PHP_EOL;
$portfolio = get_portfolio_data();
echo "   ✓ عدد المشاريع: " . count($portfolio) . PHP_EOL;

if (count($portfolio) > 0) {
    echo "   ✓ أول مشروع: " . $portfolio[0]['client_name'] . " - " . $portfolio[0]['project_title'] . PHP_EOL;
    
    // فحص نوع بيانات الخدمات
    $services_type = is_array($portfolio[0]['services']) ? 'مصفوفة' : 'نص';
    echo "   ✓ نوع بيانات الخدمات: $services_type" . PHP_EOL;
    
    // فحص إمكانية معالجة الخدمات
    $services = is_array($portfolio[0]['services']) 
        ? $portfolio[0]['services'] 
        : explode(',', $portfolio[0]['services'] ?? '');
    $services = array_map('trim', $services);
    $services = array_filter($services);
    
    echo "   ✓ عدد الخدمات بعد المعالجة: " . count($services) . PHP_EOL;
    echo "   ✓ array_slice يعمل بشكل صحيح: " . (count(array_slice($services, 0, 2)) > 0 ? 'نعم' : 'لا') . PHP_EOL;
}

echo PHP_EOL . "✓ اكتمل الاختبار الشامل!" . PHP_EOL;
