<?php
require_once 'config.php';

$portfolio = get_portfolio_data();
echo 'عدد المشاريع: ' . count($portfolio) . PHP_EOL . PHP_EOL;

if (count($portfolio) > 0) {
    echo 'أول 3 مشاريع:' . PHP_EOL;
    foreach (array_slice($portfolio, 0, 3) as $i => $project) {
        echo ($i + 1) . '. العميل: ' . $project['client_name'] . PHP_EOL;
        echo '   العنوان: ' . $project['project_title'] . PHP_EOL;
        echo '   الفئة: ' . $project['category'] . PHP_EOL;
        echo '   الخدمات (نوع): ' . gettype($project['services']) . PHP_EOL;
        
        if (is_array($project['services'])) {
            echo '   الخدمات (قيمة): ' . json_encode($project['services'], JSON_UNESCAPED_UNICODE) . PHP_EOL;
        } else {
            echo '   الخدمات (قيمة): ' . $project['services'] . PHP_EOL;
        }
        echo PHP_EOL;
    }
    
    // Test array_slice on services
    echo PHP_EOL . '=== اختبار array_slice على الخدمات ===' . PHP_EOL . PHP_EOL;
    $project = $portfolio[0];
    echo 'المشروع: ' . $project['project_title'] . PHP_EOL;
    echo 'الخدمات الأصلية: ';
    
    if (is_array($project['services'])) {
        echo 'مصفوفة - ' . json_encode($project['services'], JSON_UNESCAPED_UNICODE) . PHP_EOL;
    } else {
        echo 'نص - ' . $project['services'] . PHP_EOL;
    }
    
    // Simulate what happens in index.php
    $services = is_array($project['services']) ? $project['services'] : explode(',', $project['services'] ?? '');
    $services = array_map('trim', $services);
    $services = array_filter($services);
    
    echo 'بعد المعالجة: ' . json_encode($services, JSON_UNESCAPED_UNICODE) . PHP_EOL;
    echo 'عدد الخدمات: ' . count($services) . PHP_EOL;
    
    $sliced = array_slice($services, 0, 2);
    echo 'بعد array_slice: ' . json_encode($sliced, JSON_UNESCAPED_UNICODE) . PHP_EOL;
}
