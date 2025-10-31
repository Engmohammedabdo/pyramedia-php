<?php
$page_title = 'لوحة التحكم';
require_once 'header.php';

// Helper function to count records
function count_records($table, $where = null) {
    try {
        $conn = get_db_connection();
        $sql = "SELECT COUNT(*) as count FROM `$table`";
        if ($where) {
            $sql .= " WHERE $where";
        }
        $stmt = $conn->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    } catch (Exception $e) {
        error_log("Count error: " . $e->getMessage());
        return 0;
    }
}

// Get statistics
$stats = [
    'portfolio' => count_records('portfolio_items'),
    'messages' => count_records('contact_messages'),
    'unread_messages' => count_records('contact_messages', "status = 'unread'"),
];

// Get recent messages
$recent_messages = [];
try {
    $conn = get_db_connection();
    $stmt = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5");
    $recent_messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log("Recent messages error: " . $e->getMessage());
}
?>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Portfolio -->
    <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light hover:border-primary transition-all duration-300 transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">معرض الأعمال</p>
                <p class="text-4xl font-bold text-primary"><?php echo $stats['portfolio']; ?></p>
                <p class="text-xs text-gray-500 mt-1">مشروع</p>
            </div>
            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center">
                <i class="fas fa-briefcase text-primary text-2xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-dark-light">
            <a href="portfolio.php" class="text-primary text-sm hover:underline inline-flex items-center gap-2">
                <span>عرض الكل</span>
                <i class="fas fa-arrow-left text-xs"></i>
            </a>
        </div>
    </div>

    <!-- Messages -->
    <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light hover:border-blue-500 transition-all duration-300 transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">إجمالي الرسائل</p>
                <p class="text-4xl font-bold text-blue-500"><?php echo $stats['messages']; ?></p>
                <p class="text-xs text-gray-500 mt-1">رسالة</p>
            </div>
            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500/20 to-blue-500/5 flex items-center justify-center">
                <i class="fas fa-envelope text-blue-500 text-2xl"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-dark-light">
            <a href="messages.php" class="text-blue-500 text-sm hover:underline inline-flex items-center gap-2">
                <span>عرض الكل</span>
                <i class="fas fa-arrow-left text-xs"></i>
            </a>
        </div>
    </div>

    <!-- Unread Messages -->
    <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light hover:border-red-500 transition-all duration-300 transform hover:scale-105">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">رسائل غير مقروءة</p>
                <p class="text-4xl font-bold text-red-500"><?php echo $stats['unread_messages']; ?></p>
                <p class="text-xs text-gray-500 mt-1">رسالة جديدة</p>
            </div>
            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-red-500/20 to-red-500/5 flex items-center justify-center relative">
                <i class="fas fa-envelope-open text-red-500 text-2xl"></i>
                <?php if ($stats['unread_messages'] > 0): ?>
                <span class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-xs font-bold">
                    <?php echo min($stats['unread_messages'], 99); ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-dark-light">
            <a href="messages.php?filter=unread" class="text-red-500 text-sm hover:underline inline-flex items-center gap-2">
                <span>عرض الكل</span>
                <i class="fas fa-arrow-left text-xs"></i>
            </a>
        </div>
    </div>
</div>

<!-- Recent Messages & Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Messages (2 columns) -->
    <div class="lg:col-span-2">
        <div class="bg-dark-lighter rounded-xl border border-dark-light">
            <div class="p-6 border-b border-dark-light flex items-center justify-between">
                <h2 class="text-xl font-bold flex items-center gap-3">
                    <i class="fas fa-inbox text-primary"></i>
                    <span>أحدث الرسائل</span>
                </h2>
                <a href="messages.php" class="text-sm text-primary hover:underline">عرض الكل</a>
            </div>
            <div class="p-6">
                <?php if (empty($recent_messages)): ?>
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-gray-600 text-5xl mb-4"></i>
                        <p class="text-gray-400">لا توجد رسائل بعد</p>
                        <p class="text-sm text-gray-500 mt-2">ستظهر رسائل العملاء هنا</p>
                    </div>
                <?php else: ?>
                    <div class="space-y-3">
                        <?php foreach ($recent_messages as $message): ?>
                        <div class="flex items-start gap-4 p-4 rounded-lg border border-dark-light hover:border-primary/30 transition-colors <?php echo $message['status'] === 'unread' ? 'bg-primary/5' : 'bg-dark'; ?>">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-accent-gold flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-dark text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <p class="font-semibold text-white"><?php echo htmlspecialchars($message['name']); ?></p>
                                        <?php if ($message['status'] === 'unread'): ?>
                                        <span class="px-2 py-0.5 bg-red-500 text-white text-xs rounded-full">جديد</span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-xs text-gray-500">
                                        <?php 
                                        $time = strtotime($message['created_at']);
                                        $diff = time() - $time;
                                        if ($diff < 3600) {
                                            echo floor($diff / 60) . ' دقيقة';
                                        } elseif ($diff < 86400) {
                                            echo floor($diff / 3600) . ' ساعة';
                                        } else {
                                            echo date('Y-m-d', $time);
                                        }
                                        ?>
                                    </span>
                                </div>
                                <p class="text-sm text-gray-400 mb-2">
                                    <i class="fas fa-envelope text-xs ml-1"></i>
                                    <?php echo htmlspecialchars($message['email']); ?>
                                </p>
                                <p class="text-sm text-gray-300 line-clamp-2">
                                    <?php echo htmlspecialchars(mb_substr($message['message'], 0, 100)); ?>
                                    <?php if (mb_strlen($message['message']) > 100) echo '...'; ?>
                                </p>
                                <div class="mt-3 flex gap-2">
                                    <a href="messages.php?id=<?php echo $message['id']; ?>" 
                                       class="text-xs text-primary hover:underline">
                                        عرض التفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Actions (1 column) -->
    <div class="space-y-6">
        <div class="bg-dark-lighter rounded-xl border border-dark-light p-6">
            <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                <i class="fas fa-bolt text-accent-gold"></i>
                <span>إجراءات سريعة</span>
            </h2>
            <div class="space-y-3">
                <a href="portfolio.php?action=add" 
                   class="block p-4 rounded-lg border border-dark-light hover:border-primary hover:bg-primary/5 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-primary/20 group-hover:bg-primary flex items-center justify-center transition-colors">
                            <i class="fas fa-plus text-primary group-hover:text-dark transition-colors"></i>
                        </div>
                        <div>
                            <p class="font-medium group-hover:text-primary transition-colors">إضافة مشروع</p>
                            <p class="text-xs text-gray-500">أضف عمل جديد للمعرض</p>
                        </div>
                    </div>
                </a>

                <a href="messages.php" 
                   class="block p-4 rounded-lg border border-dark-light hover:border-blue-500 hover:bg-blue-500/5 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-500/20 group-hover:bg-blue-500 flex items-center justify-center transition-colors">
                            <i class="fas fa-envelope text-blue-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <div>
                            <p class="font-medium group-hover:text-blue-500 transition-colors">الرسائل</p>
                            <p class="text-xs text-gray-500">تحقق من رسائل العملاء</p>
                        </div>
                    </div>
                </a>

                <a href="settings.php" 
                   class="block p-4 rounded-lg border border-dark-light hover:border-green-500 hover:bg-green-500/5 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-green-500/20 group-hover:bg-green-500 flex items-center justify-center transition-colors">
                            <i class="fas fa-cog text-green-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <div>
                            <p class="font-medium group-hover:text-green-500 transition-colors">الإعدادات</p>
                            <p class="text-xs text-gray-500">إدارة إعدادات الموقع</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- System Info -->
        <div class="bg-dark-lighter rounded-xl border border-dark-light p-6">
            <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                <i class="fas fa-info-circle text-primary"></i>
                <span>معلومات النظام</span>
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-400">PHP Version:</span>
                    <span class="text-white font-mono"><?php echo PHP_VERSION; ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Server:</span>
                    <span class="text-white font-mono text-xs"><?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Database:</span>
                    <span class="text-green-500 font-mono">
                        <i class="fas fa-check-circle"></i> Connected
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<?php require_once 'footer.php'; ?>
