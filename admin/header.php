<?php
require_once 'auth.php';
require_admin_login();

$current_admin = get_current_admin();
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'لوحة التحكم'; ?> - Pyramedia Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#d4af37',
                        'primary-600': '#b8941f',
                        'accent-gold': '#f4d03f',
                        dark: '#0a0a0a',
                        'dark-lighter': '#1a1a1a',
                        'dark-light': '#2a2a2a',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-dark text-white">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 right-0 w-64 bg-dark-lighter border-l border-dark-light">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 border-b border-dark-light">
            <div class="flex items-center space-x-2 space-x-reverse">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-accent-gold flex items-center justify-center">
                    <span class="text-white font-bold text-lg">P</span>
                </div>
                <span class="text-xl font-bold">Pyramedia</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-6 px-4">
            <a href="index.php" class="flex items-center px-4 py-3 mb-2 rounded-lg <?php echo $current_page === 'index' ? 'bg-primary text-dark' : 'text-gray-300 hover:bg-dark-light'; ?> transition-colors">
                <i class="fas fa-chart-line w-5"></i>
                <span class="mr-3">لوحة التحكم</span>
            </a>
            
            <a href="portfolio.php" class="flex items-center px-4 py-3 mb-2 rounded-lg <?php echo $current_page === 'portfolio' ? 'bg-primary text-dark' : 'text-gray-300 hover:bg-dark-light'; ?> transition-colors">
                <i class="fas fa-briefcase w-5"></i>
                <span class="mr-3">أعمالنا</span>
            </a>
            
            <a href="messages.php" class="flex items-center px-4 py-3 mb-2 rounded-lg <?php echo $current_page === 'messages' ? 'bg-primary text-dark' : 'text-gray-300 hover:bg-dark-light'; ?> transition-colors">
                <i class="fas fa-envelope w-5"></i>
                <span class="mr-3">الرسائل</span>
                <?php
                $unread_count = db_count('contact_messages', 'is_read = 0');
                if ($unread_count > 0):
                ?>
                <span class="mr-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full"><?php echo $unread_count; ?></span>
                <?php endif; ?>
            </a>
            
            <a href="settings.php" class="flex items-center px-4 py-3 mb-2 rounded-lg <?php echo $current_page === 'settings' ? 'bg-primary text-dark' : 'text-gray-300 hover:bg-dark-light'; ?> transition-colors">
                <i class="fas fa-cog w-5"></i>
                <span class="mr-3">الإعدادات</span>
            </a>

            <div class="border-t border-dark-light my-4"></div>

            <a href="../index.php" target="_blank" class="flex items-center px-4 py-3 mb-2 rounded-lg text-gray-300 hover:bg-dark-light transition-colors">
                <i class="fas fa-external-link-alt w-5"></i>
                <span class="mr-3">عرض الموقع</span>
            </a>

            <a href="logout.php" class="flex items-center px-4 py-3 mb-2 rounded-lg text-red-400 hover:bg-red-500/10 transition-colors">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span class="mr-3">تسجيل الخروج</span>
            </a>
        </nav>

        <!-- User Info -->
        <div class="absolute bottom-0 right-0 left-0 p-4 border-t border-dark-light">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-dark font-bold">
                    <?php echo strtoupper(substr($current_admin['username'], 0, 1)); ?>
                </div>
                <div class="mr-3">
                    <p class="text-sm font-medium"><?php echo htmlspecialchars($current_admin['full_name'] ?? $current_admin['username']); ?></p>
                    <p class="text-xs text-gray-400"><?php echo htmlspecialchars($current_admin['role']); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="mr-64 min-h-screen">
        <!-- Top Bar -->
        <div class="bg-dark-lighter border-b border-dark-light px-8 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold"><?php echo $page_title ?? 'لوحة التحكم'; ?></h1>
                <div class="text-sm text-gray-400">
                    <i class="far fa-clock ml-2"></i>
                    <?php echo date('Y-m-d H:i'); ?>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-8">

