<?php
/**
 * Database Setup Script for Bluehost
 * 
 * هذا السكريبت يقوم بإنشاء جداول قاعدة البيانات واستيراد البيانات الأولية
 * 
 * الاستخدام:
 * 1. رفع هذا الملف إلى المجلد الرئيسي للموقع على Bluehost
 * 2. زيارة الرابط: https://yourdomain.com/setup_database.php
 * 3. حذف الملف بعد الانتهاء من الإعداد لأسباب أمنية
 */

// عرض الأخطاء للتشخيص
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html>
<html lang='ar' dir='rtl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>إعداد قاعدة البيانات - Pyramedia</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 40px;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 { color: #667eea; margin-bottom: 30px; text-align: center; }
        .step { 
            background: #f8f9fa; 
            padding: 20px; 
            margin: 15px 0; 
            border-radius: 5px;
            border-left: 4px solid #667eea;
        }
        .success { border-left-color: #28a745; background: #d4edda; }
        .error { border-left-color: #dc3545; background: #f8d7da; }
        .warning { border-left-color: #ffc107; background: #fff3cd; }
        .step-title { font-weight: bold; margin-bottom: 10px; font-size: 18px; }
        .step-content { color: #666; line-height: 1.6; }
        pre { 
            background: #2d2d2d; 
            color: #f8f8f2; 
            padding: 15px; 
            border-radius: 5px; 
            overflow-x: auto;
            margin: 10px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
        }
        .btn:hover { background: #5568d3; }
    </style>
</head>
<body>
<div class='container'>";

echo "<h1>🚀 إعداد قاعدة البيانات - Pyramedia</h1>";

// 1. الاتصال بقاعدة البيانات
echo "<div class='step'>";
echo "<div class='step-title'>الخطوة 1: الاتصال بقاعدة البيانات</div>";
echo "<div class='step-content'>";

require_once __DIR__ . '/db.php';

try {
    $conn = get_db_connection();
    echo "✅ تم الاتصال بقاعدة البيانات بنجاح<br>";
    echo "📊 قاعدة البيانات: " . DB_NAME . "<br>";
    echo "👤 المستخدم: " . DB_USER . "<br>";
    echo "🖥️ الخادم: " . DB_HOST;
    echo "</div></div>";
    
    echo "<div class='step success'>";
    echo "<div class='step-title'>✓ الاتصال ناجح</div>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "❌ فشل الاتصال: " . $e->getMessage();
    echo "</div></div>";
    
    echo "<div class='step error'>";
    echo "<div class='step-title'>✗ خطأ في الاتصال</div>";
    echo "<div class='step-content'>";
    echo "الرجاء التحقق من:<br>";
    echo "1. اسم قاعدة البيانات صحيح<br>";
    echo "2. اسم المستخدم وكلمة المرور صحيحة<br>";
    echo "3. قاعدة البيانات موجودة في cPanel";
    echo "</div></div>";
    echo "</div></body></html>";
    exit;
}

// 2. إنشاء جدول portfolio_items
echo "<div class='step'>";
echo "<div class='step-title'>الخطوة 2: إنشاء جدول portfolio_items</div>";
echo "<div class='step-content'>";

$create_table_sql = "CREATE TABLE IF NOT EXISTS `portfolio_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `client` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text,
  `image` varchar(500),
  `services` text,
  `duration` varchar(100),
  `year` int(4),
  `order_index` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `order_index` (`order_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

try {
    $conn->exec($create_table_sql);
    echo "✅ تم إنشاء جدول portfolio_items بنجاح";
    echo "</div></div>";
    
    echo "<div class='step success'>";
    echo "<div class='step-title'>✓ الجدول جاهز</div>";
    echo "</div>";
    
} catch (PDOException $e) {
    echo "❌ خطأ: " . $e->getMessage();
    echo "</div></div>";
}

// 2.5. إنشاء جدول contact_messages
echo "<div class='step'>";
echo "<div class='step-title'>الخطوة 2.5: إنشاء جدول contact_messages</div>";
echo "<div class='step-content'>";

$create_messages_table_sql = "CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50),
  `subject` varchar(255),
  `message` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

try {
    $conn->exec($create_messages_table_sql);
    echo "✅ تم إنشاء جدول contact_messages بنجاح";
    echo "</div></div>";
    
    echo "<div class='step success'>";
    echo "<div class='step-title'>✓ جدول الرسائل جاهز</div>";
    echo "</div>";
    
} catch (PDOException $e) {
    echo "❌ خطأ: " . $e->getMessage();
    echo "</div></div>";
}

// 3. استيراد البيانات من JSON
echo "<div class='step'>";
echo "<div class='step-title'>الخطوة 3: استيراد بيانات معرض الأعمال</div>";
echo "<div class='step-content'>";

$json_file = __DIR__ . '/pyramedia-portfolio.json';

if (!file_exists($json_file)) {
    echo "⚠️ ملف pyramedia-portfolio.json غير موجود<br>";
    echo "سيتم تخطي هذه الخطوة";
    echo "</div></div>";
} else {
    $json_content = file_get_contents($json_file);
    $portfolio_data = json_decode($json_content, true);
    
    if (!$portfolio_data) {
        echo "❌ فشل في قراءة ملف JSON";
        echo "</div></div>";
    } else {
        echo "📄 تم قراءة " . count($portfolio_data) . " مشروع من الملف<br><br>";
        
        // حذف البيانات القديمة
        try {
            $conn->exec("DELETE FROM portfolio_items");
            echo "🗑️ تم حذف البيانات القديمة<br><br>";
        } catch (PDOException $e) {
            echo "⚠️ تحذير: " . $e->getMessage() . "<br><br>";
        }
        
        // استيراد البيانات الجديدة
        $imported = 0;
        $errors = 0;
        
        foreach ($portfolio_data as $index => $project) {
            try {
                $stmt = $conn->prepare("INSERT INTO portfolio_items 
                    (title, client, category, description, image, services, duration, year, order_index, created_at, updated_at) 
                    VALUES (:title, :client, :category, :description, :image, :services, :duration, :year, :order_index, NOW(), NOW())");
                
                $stmt->execute([
                    ':title' => $project['title'],
                    ':client' => $project['client'],
                    ':category' => $project['category'],
                    ':description' => $project['description'] ?? '',
                    ':image' => $project['image'] ?? '',
                    ':services' => isset($project['tags']) ? implode(', ', $project['tags']) : '',
                    ':duration' => $project['duration'] ?? '',
                    ':year' => null,
                    ':order_index' => $index + 1
                ]);
                
                $imported++;
                
            } catch (PDOException $e) {
                $errors++;
                echo "❌ خطأ في المشروع " . ($index + 1) . ": " . $e->getMessage() . "<br>";
            }
        }
        
        echo "<br>📊 النتائج:<br>";
        echo "✅ تم استيراد: $imported مشروع<br>";
        if ($errors > 0) {
            echo "❌ فشل: $errors مشروع<br>";
        }
        echo "</div></div>";
        
        if ($errors == 0) {
            echo "<div class='step success'>";
            echo "<div class='step-title'>✓ تم استيراد جميع البيانات بنجاح</div>";
            echo "</div>";
        }
    }
}

// 4. التحقق النهائي
echo "<div class='step'>";
echo "<div class='step-title'>الخطوة 4: التحقق النهائي</div>";
echo "<div class='step-content'>";

try {
    $stmt = $conn->query("SELECT COUNT(*) as count FROM portfolio_items");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['count'];
    
    echo "📊 عدد المشاريع في قاعدة البيانات: <strong>$count</strong><br><br>";
    
    if ($count > 0) {
        echo "عرض أول 3 مشاريع:<br><br>";
        $stmt = $conn->query("SELECT * FROM portfolio_items ORDER BY order_index ASC LIMIT 3");
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<pre>";
        foreach ($items as $i => $item) {
            echo ($i + 1) . ". " . $item['client'] . " - " . $item['title'] . "\n";
            echo "   الفئة: " . $item['category'] . "\n";
            echo "   الخدمات: " . $item['services'] . "\n\n";
        }
        echo "</pre>";
    }
    
    echo "</div></div>";
    
    echo "<div class='step success'>";
    echo "<div class='step-title'>🎉 اكتمل الإعداد بنجاح!</div>";
    echo "<div class='step-content'>";
    echo "قاعدة البيانات جاهزة للاستخدام<br>";
    echo "يمكنك الآن زيارة موقعك والتحقق من عمله بشكل صحيح";
    echo "</div></div>";
    
    echo "<div class='step warning'>";
    echo "<div class='step-title'>⚠️ تحذير أمني مهم</div>";
    echo "<div class='step-content'>";
    echo "<strong>يجب حذف هذا الملف (setup_database.php) فوراً لأسباب أمنية!</strong><br><br>";
    echo "يمكنك حذفه من خلال:<br>";
    echo "1. File Manager في cPanel<br>";
    echo "2. FTP Client<br>";
    echo "3. SSH (إذا كان متاحاً)";
    echo "</div></div>";
    
} catch (PDOException $e) {
    echo "❌ خطأ في التحقق: " . $e->getMessage();
    echo "</div></div>";
}

echo "<div style='text-align: center; margin-top: 30px;'>";
echo "<a href='/' class='btn'>🏠 الذهاب إلى الموقع</a>";
echo "</div>";

echo "</div></body></html>";
?>
