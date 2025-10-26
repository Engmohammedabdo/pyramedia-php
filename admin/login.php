<?php
require_once 'auth.php';

// Redirect if already logged in
if (is_admin_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize_input($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    if (empty($username) || empty($password)) {
        $error = 'يرجى إدخال اسم المستخدم وكلمة المرور';
    } elseif (admin_login($username, $password, $remember)) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'اسم المستخدم أو كلمة المرور غير صحيحة';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - Pyramedia Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="bg-dark min-h-screen flex items-center justify-center">
    <!-- Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-accent-gold rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-md px-4">
        <div class="bg-dark-lighter rounded-2xl shadow-2xl border border-dark-light p-8">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-primary to-accent-gold mb-4">
                    <span class="text-white font-bold text-2xl">P</span>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Pyramedia Admin</h1>
                <p class="text-gray-400">لوحة التحكم الإدارية</p>
            </div>

            <!-- Error Message -->
            <?php if ($error): ?>
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-lg">
                <p class="text-red-400 text-sm"><?php echo htmlspecialchars($error); ?></p>
            </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="POST" action="" class="space-y-6">
                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-300 mb-2">
                        اسم المستخدم
                    </label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           required
                           class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-primary transition-colors"
                           placeholder="أدخل اسم المستخدم"
                           value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                        كلمة المرور
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required
                           class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-primary transition-colors"
                           placeholder="أدخل كلمة المرور">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="remember" 
                           name="remember" 
                           class="w-4 h-4 text-primary bg-dark border-dark-light rounded focus:ring-primary focus:ring-2">
                    <label for="remember" class="mr-2 text-sm text-gray-300">
                        تذكرني لمدة 30 يوم
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3 bg-primary hover:bg-primary-600 text-dark font-semibold rounded-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                    تسجيل الدخول
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-400">
                    © <?php echo date('Y'); ?> Pyramedia. جميع الحقوق محفوظة.
                </p>
            </div>
        </div>

        <!-- Default Credentials Info (Remove in production) -->
        <div class="mt-4 p-4 bg-blue-500/10 border border-blue-500/30 rounded-lg">
            <p class="text-blue-400 text-xs text-center">
                <strong>معلومات تسجيل الدخول الافتراضية:</strong><br>
                Username: admin | Password: admin123
            </p>
        </div>
    </div>
</body>
</html>

