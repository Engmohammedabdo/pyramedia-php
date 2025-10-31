<?php
require_once 'db.php';

echo "=== فحص قاعدة البيانات ===" . PHP_EOL . PHP_EOL;

try {
    $items = db_fetch_all('SELECT * FROM portfolio_items LIMIT 5');
    echo 'عدد المشاريع في قاعدة البيانات: ' . count($items) . PHP_EOL . PHP_EOL;
    
    if (!empty($items)) {
        echo 'أول مشروع:' . PHP_EOL;
        print_r($items[0]);
    } else {
        echo 'قاعدة البيانات فارغة - سيتم استخدام ملف JSON' . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'خطأ في الاتصال بقاعدة البيانات: ' . $e->getMessage() . PHP_EOL;
    echo 'سيتم استخدام ملف JSON كبديل' . PHP_EOL;
}

echo PHP_EOL . "=== اختبار دالة get_portfolio_data ===" . PHP_EOL . PHP_EOL;

require_once 'config.php';
$portfolio = get_portfolio_data();

echo 'عدد المشاريع المسترجعة: ' . count($portfolio) . PHP_EOL . PHP_EOL;

if (!empty($portfolio)) {
    echo 'أول 3 مشاريع:' . PHP_EOL;
    foreach (array_slice($portfolio, 0, 3) as $i => $project) {
        echo ($i + 1) . '. ' . $project['client_name'] . ' - ' . $project['project_title'] . PHP_EOL;
        echo '   الفئة: ' . $project['category'] . PHP_EOL;
        echo '   الخدمات: ' . (is_array($project['services']) ? implode(', ', $project['services']) : $project['services']) . PHP_EOL;
        echo PHP_EOL;
    }
}
