<?php
require_once 'config.php';
require_once 'db.php';
$page_title = 'تواصل معنا';
include 'header.php';

// Handle form submission
$success = false;
$error = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        $error = true;
        $error_message = 'يرجى ملء جميع الحقول المطلوبة';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $error_message = 'البريد الإلكتروني غير صحيح';
    } elseif (strlen($name) > 100) {
        $error = true;
        $error_message = 'الاسم طويل جداً (الحد الأقصى 100 حرف)';
    } elseif (strlen($message) > 2000) {
        $error = true;
        $error_message = 'الرسالة طويلة جداً (الحد الأقصى 2000 حرف)';
    } else {
        // Save to database
        try {
            $data = [
                'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
                'phone' => htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'),
                'service' => htmlspecialchars($service, ENT_QUOTES, 'UTF-8'),
                'message' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8'),
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
            ];

            $id = db_insert('contact_messages', $data);

            if ($id) {
                $success = true;
                // Clear form data on success
                $name = $email = $phone = $service = $message = '';
            } else {
                $error = true;
                $error_message = 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.';
            }
        } catch (Exception $e) {
            error_log("Contact form error: " . $e->getMessage());
            $error = true;
            $error_message = 'حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى لاحقاً.';
        }
    }
}
?>

<!-- Page Header -->
<section class="relative py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-dark via-dark-lighter to-dark">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-primary rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
            <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-accent-gold rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: 1s;"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-12">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
            <span class="gradient-text">تواصل معنا</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto">
            نحن هنا للإجابة على استفساراتك ومساعدتك في تحقيق أهدافك التسويقية
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div>
                <h2 class="text-3xl font-bold mb-6">معلومات التواصل</h2>
                <p class="text-lg text-gray-300 mb-8">
                    تواصل معنا اليوم واحصل على استشارة مجانية لمشروعك. فريقنا جاهز لمساعدتك في تحقيق أهدافك التسويقية.
                </p>

                <!-- Contact Cards -->
                <div class="space-y-6">
                    <!-- Email -->
                    <div class="flex items-start gap-4 p-6 bg-dark-lighter rounded-xl border border-dark-light hover:border-primary transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-1">البريد الإلكتروني</h3>
                            <a href="mailto:<?php echo CONTACT_EMAIL; ?>" class="text-gray-400 hover:text-primary transition-colors">
                                <?php echo CONTACT_EMAIL; ?>
                            </a>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start gap-4 p-6 bg-dark-lighter rounded-xl border border-dark-light hover:border-primary transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-1">الهاتف</h3>
                            <a href="tel:<?php echo str_replace(' ', '', CONTACT_PHONE); ?>" class="text-gray-400 hover:text-primary transition-colors">
                                <?php echo CONTACT_PHONE; ?>
                            </a>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="flex items-start gap-4 p-6 bg-dark-lighter rounded-xl border border-dark-light hover:border-primary transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-1">الموقع</h3>
                            <p class="text-gray-400"><?php echo CONTACT_ADDRESS; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="text-lg font-bold mb-4">تابعنا على</h3>
                    <div class="flex gap-4">
                        <a href="<?php echo SOCIAL_FACEBOOK; ?>" target="_blank" rel="noopener noreferrer"
                           class="w-12 h-12 rounded-lg bg-white/5 hover:bg-primary/20 flex items-center justify-center text-gray-400 hover:text-primary transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="<?php echo SOCIAL_INSTAGRAM; ?>" target="_blank" rel="noopener noreferrer"
                           class="w-12 h-12 rounded-lg bg-white/5 hover:bg-primary/20 flex items-center justify-center text-gray-400 hover:text-primary transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="<?php echo SOCIAL_TWITTER; ?>" target="_blank" rel="noopener noreferrer"
                           class="w-12 h-12 rounded-lg bg-white/5 hover:bg-primary/20 flex items-center justify-center text-gray-400 hover:text-primary transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="<?php echo SOCIAL_LINKEDIN; ?>" target="_blank" rel="noopener noreferrer"
                           class="w-12 h-12 rounded-lg bg-white/5 hover:bg-primary/20 flex items-center justify-center text-gray-400 hover:text-primary transition-colors duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                <?php if ($success): ?>
                    <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-6 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="text-lg font-bold text-green-500 mb-1">تم إرسال رسالتك بنجاح!</h3>
                                <p class="text-gray-300">سنتواصل معك في أقرب وقت ممكن.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-6 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="text-lg font-bold text-red-500 mb-1">خطأ!</h3>
                                <p class="text-gray-300"><?php echo htmlspecialchars($error_message); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" class="bg-dark-lighter rounded-xl p-8 border border-dark-light">
                    <h2 class="text-2xl font-bold mb-6">أرسل لنا رسالة</h2>

                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2">الاسم *</label>
                            <input type="text" id="name" name="name" required
                                   value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                   class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg focus:border-primary focus:outline-none transition-colors text-white">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium mb-2">البريد الإلكتروني *</label>
                            <input type="email" id="email" name="email" required
                                   value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                   class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg focus:border-primary focus:outline-none transition-colors text-white">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium mb-2">رقم الهاتف</label>
                            <input type="tel" id="phone" name="phone"
                                   value="<?php echo htmlspecialchars($phone ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                   class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg focus:border-primary focus:outline-none transition-colors text-white">
                        </div>

                        <!-- Service -->
                        <div>
                            <label for="service" class="block text-sm font-medium mb-2">الخدمة المطلوبة</label>
                            <select id="service" name="service"
                                    class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg focus:border-primary focus:outline-none transition-colors text-white">
                                <option value="">اختر الخدمة</option>
                                <option value="design" <?php echo ($service ?? '') === 'design' ? 'selected' : ''; ?>>التصميم الجرافيكي</option>
                                <option value="social" <?php echo ($service ?? '') === 'social' ? 'selected' : ''; ?>>إدارة السوشيال ميديا</option>
                                <option value="marketing" <?php echo ($service ?? '') === 'marketing' ? 'selected' : ''; ?>>التسويق الرقمي</option>
                                <option value="video" <?php echo ($service ?? '') === 'video' ? 'selected' : ''; ?>>إنتاج الفيديو</option>
                                <option value="web" <?php echo ($service ?? '') === 'web' ? 'selected' : ''; ?>>تطوير المواقع</option>
                                <option value="ai" <?php echo ($service ?? '') === 'ai' ? 'selected' : ''; ?>>حلول الذكاء الاصطناعي</option>
                                <option value="other" <?php echo ($service ?? '') === 'other' ? 'selected' : ''; ?>>أخرى</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium mb-2">الرسالة *</label>
                            <textarea id="message" name="message" rows="5" required
                                      class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg focus:border-primary focus:outline-none transition-colors text-white resize-none"><?php echo htmlspecialchars($message ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full px-6 py-4 bg-primary hover:bg-primary-600 text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105 inline-flex items-center justify-center gap-2">
                            <span>إرسال الرسالة</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
