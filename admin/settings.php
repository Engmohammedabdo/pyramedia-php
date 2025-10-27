<?php
$page_title = 'الإعدادات';
require_once 'header.php';

$success = '';
$error = '';

// Handle settings update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'رمز الأمان غير صحيح';
    } else {
        $settings_to_update = [
            'site_name',
            'site_description',
            'contact_email',
            'contact_phone',
            'contact_address',
            'facebook_url',
            'instagram_url',
            'twitter_url',
            'linkedin_url',
        ];
        
        $updated = 0;
        foreach ($settings_to_update as $key) {
            if (isset($_POST[$key])) {
                $value = sanitize_input($_POST[$key]);
                if (db_update('site_settings', ['setting_value' => $value], 'setting_key = :key', [':key' => $key])) {
                    $updated++;
                }
            }
        }
        
        if ($updated > 0) {
            $success = "تم تحديث $updated إعداد بنجاح";
            log_admin_activity($_SESSION['admin_id'], 'update_settings', "Updated $updated site settings");
        }
    }
}

// Get current settings
$settings_raw = db_fetch_all("SELECT setting_key, setting_value FROM site_settings");
$settings = [];
foreach ($settings_raw as $setting) {
    $settings[$setting['setting_key']] = $setting['setting_value'];
}
?>

<!-- Success/Error Messages -->
<?php if ($success): ?>
<div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-lg" data-auto-hide>
    <p class="text-green-400"><?php echo htmlspecialchars($success); ?></p>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-lg" data-auto-hide>
    <p class="text-red-400"><?php echo htmlspecialchars($error); ?></p>
</div>
<?php endif; ?>

<form method="POST" class="space-y-8">
    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
    
    <!-- Site Information -->
    <div class="bg-dark-lighter rounded-xl border border-dark-light p-6">
        <h2 class="text-xl font-bold mb-6">معلومات الموقع</h2>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">اسم الموقع</label>
                <input type="text" name="site_name" 
                       value="<?php echo htmlspecialchars($settings['site_name'] ?? ''); ?>"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">وصف الموقع</label>
                <textarea name="site_description" rows="3"
                          class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary"><?php echo htmlspecialchars($settings['site_description'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>
    
    <!-- Contact Information -->
    <div class="bg-dark-lighter rounded-xl border border-dark-light p-6">
        <h2 class="text-xl font-bold mb-6">معلومات التواصل</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">البريد الإلكتروني</label>
                <input type="email" name="contact_email" 
                       value="<?php echo htmlspecialchars($settings['contact_email'] ?? ''); ?>"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">رقم الهاتف</label>
                <input type="text" name="contact_phone" 
                       value="<?php echo htmlspecialchars($settings['contact_phone'] ?? ''); ?>"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-300 mb-2">العنوان</label>
                <input type="text" name="contact_address" 
                       value="<?php echo htmlspecialchars($settings['contact_address'] ?? ''); ?>"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
        </div>
    </div>
    
    <!-- Social Media -->
    <div class="bg-dark-lighter rounded-xl border border-dark-light p-6">
        <h2 class="text-xl font-bold mb-6">وسائل التواصل الاجتماعي</h2>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    <i class="fab fa-facebook text-blue-500 ml-2"></i>
                    Facebook
                </label>
                <input type="url" name="facebook_url" 
                       value="<?php echo htmlspecialchars($settings['facebook_url'] ?? ''); ?>"
                       placeholder="https://facebook.com/pyramedia"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    <i class="fab fa-instagram text-pink-500 ml-2"></i>
                    Instagram
                </label>
                <input type="url" name="instagram_url" 
                       value="<?php echo htmlspecialchars($settings['instagram_url'] ?? ''); ?>"
                       placeholder="https://instagram.com/pyramedia"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    <i class="fab fa-twitter text-blue-400 ml-2"></i>
                    Twitter
                </label>
                <input type="url" name="twitter_url" 
                       value="<?php echo htmlspecialchars($settings['twitter_url'] ?? ''); ?>"
                       placeholder="https://twitter.com/pyramedia"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    <i class="fab fa-linkedin text-blue-600 ml-2"></i>
                    LinkedIn
                </label>
                <input type="url" name="linkedin_url" 
                       value="<?php echo htmlspecialchars($settings['linkedin_url'] ?? ''); ?>"
                       placeholder="https://linkedin.com/company/pyramedia"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
        </div>
    </div>
    
    <!-- Save Button -->
    <div class="flex justify-end">
        <button type="submit" class="px-8 py-3 bg-primary hover:bg-primary-600 text-dark font-semibold rounded-lg transition-all duration-300 hover:shadow-xl">
            <i class="fas fa-save ml-2"></i>
            حفظ التغييرات
        </button>
    </div>
</form>

<?php require_once 'footer.php'; ?>
