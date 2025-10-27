<?php
$page_title = 'لوحة التحكم';
require_once 'header.php';

// Get statistics
$stats = [
    'portfolio' => db_count('portfolio_items'),
    'messages' => db_count('contact_messages'),
    'unread_messages' => db_count('contact_messages', 'is_read = 0'),
    'services' => db_count('services', 'is_active = 1'),
];

// Get recent messages
$recent_messages = db_fetch_all(
    "SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5"
);

// Get recent activity
$recent_activity = db_fetch_all(
    "SELECT al.*, au.username 
     FROM admin_activity_log al 
     JOIN admin_users au ON al.admin_id = au.id 
     ORDER BY al.created_at DESC 
     LIMIT 10"
);
?>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Portfolio -->
    <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">أعمالنا</p>
                <p class="text-3xl font-bold"><?php echo $stats['portfolio']; ?></p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-primary/20 flex items-center justify-center">
                <i class="fas fa-briefcase text-primary text-xl"></i>
            </div>
        </div>
        <a href="portfolio.php" class="text-primary text-sm mt-4 inline-block hover:underline">
            عرض الكل <i class="fas fa-arrow-left mr-1"></i>
        </a>
    </div>

    <!-- Messages -->
    <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">الرسائل</p>
                <p class="text-3xl font-bold"><?php echo $stats['messages']; ?></p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-blue-500/20 flex items-center justify-center">
                <i class="fas fa-envelope text-blue-500 text-xl"></i>
            </div>
        </div>
        <a href="messages.php" class="text-blue-500 text-sm mt-4 inline-block hover:underline">
            عرض الكل <i class="fas fa-arrow-left mr-1"></i>
        </a>
    </div>

    <!-- Unread Messages -->
    <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">رسائل غير مقروءة</p>
                <p class="text-3xl font-bold text-red-400"><?php echo $stats['unread_messages']; ?></p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-red-500/20 flex items-center justify-center">
                <i class="fas fa-envelope-open text-red-500 text-xl"></i>
            </div>
        </div>
        <a href="messages.php?filter=unread" class="text-red-400 text-sm mt-4 inline-block hover:underline">
            عرض الكل <i class="fas fa-arrow-left mr-1"></i>
        </a>
    </div>

    <!-- Services -->
    <div class="bg-dark-lighter rounded-xl p-6 border border-dark-light">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-400 text-sm mb-1">الخدمات النشطة</p>
                <p class="text-3xl font-bold"><?php echo $stats['services']; ?></p>
            </div>
            <div class="w-12 h-12 rounded-lg bg-green-500/20 flex items-center justify-center">
                <i class="fas fa-cogs text-green-500 text-xl"></i>
            </div>
        </div>
        <a href="settings.php#services" class="text-green-500 text-sm mt-4 inline-block hover:underline">
            إدارة الخدمات <i class="fas fa-arrow-left mr-1"></i>
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Messages -->
    <div class="bg-dark-lighter rounded-xl border border-dark-light">
        <div class="p-6 border-b border-dark-light">
            <h2 class="text-xl font-bold">أحدث الرسائل</h2>
        </div>
        <div class="p-6">
            <?php if (empty($recent_messages)): ?>
                <p class="text-gray-400 text-center py-8">لا توجد رسائل</p>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($recent_messages as $message): ?>
                    <div class="flex items-start space-x-4 space-x-reverse p-4 rounded-lg <?php echo $message['is_read'] ? 'bg-dark' : 'bg-primary/10'; ?>">
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-dark"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-medium"><?php echo htmlspecialchars($message['name']); ?></p>
                                <span class="text-xs text-gray-400"><?php echo date('Y-m-d H:i', strtotime($message['created_at'])); ?></span>
                            </div>
                            <p class="text-sm text-gray-400 mb-1"><?php echo htmlspecialchars($message['email']); ?></p>
                            <p class="text-sm text-gray-300 truncate"><?php echo htmlspecialchars($message['message']); ?></p>
                        </div>
                        <?php if (!$message['is_read']): ?>
                        <span class="w-2 h-2 rounded-full bg-primary flex-shrink-0"></span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <a href="messages.php" class="block text-center text-primary hover:underline mt-4">
                    عرض جميع الرسائل
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-dark-lighter rounded-xl border border-dark-light">
        <div class="p-6 border-b border-dark-light">
            <h2 class="text-xl font-bold">النشاط الأخير</h2>
        </div>
        <div class="p-6">
            <?php if (empty($recent_activity)): ?>
                <p class="text-gray-400 text-center py-8">لا يوجد نشاط</p>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($recent_activity as $activity): ?>
                    <div class="flex items-start space-x-3 space-x-reverse">
                        <div class="w-8 h-8 rounded-full bg-dark flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-history text-primary text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm">
                                <span class="font-medium text-primary"><?php echo htmlspecialchars($activity['username']); ?></span>
                                <span class="text-gray-300"> - <?php echo htmlspecialchars($activity['description'] ?? $activity['action']); ?></span>
                            </p>
                            <p class="text-xs text-gray-400 mt-1"><?php echo date('Y-m-d H:i', strtotime($activity['created_at'])); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="portfolio.php?action=add" class="bg-dark-lighter rounded-xl p-6 border border-dark-light hover:border-primary transition-colors group">
        <div class="flex items-center space-x-4 space-x-reverse">
            <div class="w-12 h-12 rounded-lg bg-primary/20 group-hover:bg-primary flex items-center justify-center transition-colors">
                <i class="fas fa-plus text-primary group-hover:text-dark text-xl transition-colors"></i>
            </div>
            <div>
                <p class="font-medium">إضافة عمل جديد</p>
                <p class="text-sm text-gray-400">أضف مشروع جديد للـ Portfolio</p>
            </div>
        </div>
    </a>

    <a href="messages.php" class="bg-dark-lighter rounded-xl p-6 border border-dark-light hover:border-blue-500 transition-colors group">
        <div class="flex items-center space-x-4 space-x-reverse">
            <div class="w-12 h-12 rounded-lg bg-blue-500/20 group-hover:bg-blue-500 flex items-center justify-center transition-colors">
                <i class="fas fa-envelope text-blue-500 group-hover:text-white text-xl transition-colors"></i>
            </div>
            <div>
                <p class="font-medium">عرض الرسائل</p>
                <p class="text-sm text-gray-400">تحقق من رسائل العملاء</p>
            </div>
        </div>
    </a>

    <a href="settings.php" class="bg-dark-lighter rounded-xl p-6 border border-dark-light hover:border-green-500 transition-colors group">
        <div class="flex items-center space-x-4 space-x-reverse">
            <div class="w-12 h-12 rounded-lg bg-green-500/20 group-hover:bg-green-500 flex items-center justify-center transition-colors">
                <i class="fas fa-cog text-green-500 group-hover:text-white text-xl transition-colors"></i>
            </div>
            <div>
                <p class="font-medium">الإعدادات</p>
                <p class="text-sm text-gray-400">إدارة إعدادات الموقع</p>
            </div>
        </div>
    </a>
</div>

<?php require_once 'footer.php'; ?>
