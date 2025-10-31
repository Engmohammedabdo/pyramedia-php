<?php
/**
 * Portfolio Data Import Script
 * 
 * هذا السكريبت يقوم باستيراد بيانات معرض الأعمال من ملف pyramedia-portfolio.json
 * إلى جدول portfolio_items في قاعدة البيانات
 */

require_once __DIR__ . '/db.php';

echo "=== بدء عملية استيراد بيانات معرض الأعمال ===" . PHP_EOL . PHP_EOL;

// 1. قراءة ملف JSON
$json_file = __DIR__ . '/pyramedia-portfolio.json';

if (!file_exists($json_file)) {
    die("خطأ: ملف pyramedia-portfolio.json غير موجود!" . PHP_EOL);
}

echo "1. قراءة ملف JSON..." . PHP_EOL;
$json_content = file_get_contents($json_file);
$portfolio_data = json_decode($json_content, true);

if (!$portfolio_data) {
    die("خطأ: فشل في قراءة ملف JSON!" . PHP_EOL);
}

echo "   ✓ تم قراءة " . count($portfolio_data) . " مشروع من الملف" . PHP_EOL . PHP_EOL;

// 2. الاتصال بقاعدة البيانات
echo "2. الاتصال بقاعدة البيانات..." . PHP_EOL;

try {
    $conn = get_db_connection();
    echo "   ✓ تم الاتصال بقاعدة البيانات بنجاح" . PHP_EOL . PHP_EOL;
} catch (Exception $e) {
    die("   ✗ فشل الاتصال بقاعدة البيانات: " . $e->getMessage() . PHP_EOL);
}

// 3. حذف البيانات القديمة
echo "3. حذف البيانات القديمة..." . PHP_EOL;

try {
    $deleted = db_delete('portfolio_items', '1=1');
    echo "   ✓ تم حذف " . $deleted . " سجل قديم" . PHP_EOL . PHP_EOL;
} catch (Exception $e) {
    echo "   ! تحذير: " . $e->getMessage() . PHP_EOL . PHP_EOL;
}

// 4. استيراد البيانات الجديدة
echo "4. استيراد البيانات الجديدة..." . PHP_EOL;

$imported = 0;
$errors = 0;

foreach ($portfolio_data as $index => $project) {
    try {
        // تحضير البيانات للإدخال
        $data = [
            'title' => $project['title'],
            'client' => $project['client'],
            'category' => $project['category'],
            'description' => $project['description'] ?? '',
            'image' => $project['image'] ?? '',
            'services' => isset($project['tags']) ? implode(', ', $project['tags']) : '',
            'duration' => $project['duration'] ?? '',
            'year' => null,
            'order_index' => $index + 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // إدخال البيانات
        $id = db_insert('portfolio_items', $data);
        
        if ($id) {
            $imported++;
            echo "   ✓ [" . ($index + 1) . "/" . count($portfolio_data) . "] " . $project['client'] . " - " . $project['title'] . PHP_EOL;
        }
        
    } catch (Exception $e) {
        $errors++;
        echo "   ✗ [" . ($index + 1) . "] خطأ: " . $e->getMessage() . PHP_EOL;
    }
}

echo PHP_EOL;

// 5. ملخص العملية
echo "=== ملخص عملية الاستيراد ===" . PHP_EOL . PHP_EOL;
echo "إجمالي المشاريع في الملف: " . count($portfolio_data) . PHP_EOL;
echo "تم استيرادها بنجاح: " . $imported . PHP_EOL;
echo "فشل استيرادها: " . $errors . PHP_EOL . PHP_EOL;

// 6. التحقق من البيانات المستوردة
echo "=== التحقق من البيانات المستوردة ===" . PHP_EOL . PHP_EOL;

try {
    $count = db_count('portfolio_items');
    echo "عدد المشاريع في قاعدة البيانات: " . $count . PHP_EOL . PHP_EOL;
    
    if ($count > 0) {
        echo "أول 3 مشاريع:" . PHP_EOL;
        $items = db_fetch_all("SELECT * FROM portfolio_items ORDER BY order_index ASC LIMIT 3");
        
        foreach ($items as $i => $item) {
            echo ($i + 1) . ". " . $item['client'] . " - " . $item['title'] . PHP_EOL;
            echo "   الفئة: " . $item['category'] . PHP_EOL;
            echo "   الخدمات: " . $item['services'] . PHP_EOL;
            echo PHP_EOL;
        }
    }
    
    echo "✓ تمت عملية الاستيراد بنجاح!" . PHP_EOL;
    
} catch (Exception $e) {
    echo "خطأ في التحقق: " . $e->getMessage() . PHP_EOL;
}
