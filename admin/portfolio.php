<?php
$page_title = 'إدارة أعمالنا';
require_once 'header.php';

$success = '';
$error = '';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'رمز الأمان غير صحيح';
    } else {
        $action = $_POST['action'] ?? '';
        
        switch ($action) {
            case 'add':
                $data = [
                    'title' => sanitize_input($_POST['title'] ?? ''),
                    'client' => sanitize_input($_POST['client'] ?? ''),
                    'category' => sanitize_input($_POST['category'] ?? ''),
                    'description' => sanitize_input($_POST['description'] ?? ''),
                    'services' => sanitize_input($_POST['services'] ?? ''),
                    'duration' => sanitize_input($_POST['duration'] ?? ''),
                    'year' => (int)($_POST['year'] ?? date('Y')),
                    'featured' => isset($_POST['featured']) ? 1 : 0,
                ];
                
                if (empty($data['title']) || empty($data['client'])) {
                    $error = 'يرجى إدخال العنوان واسم العميل';
                } else {
                    $id = db_insert('portfolio_items', $data);
                    if ($id) {
                        $success = 'تم إضافة العمل بنجاح';
                        log_admin_activity($_SESSION['admin_id'], 'add_portfolio', "Added portfolio item: {$data['title']}");
                    } else {
                        $error = 'حدث خطأ أثناء الإضافة';
                    }
                }
                break;
                
            case 'delete':
                $id = (int)($_POST['portfolio_id'] ?? 0);
                if (db_delete('portfolio_items', 'id = :id', [':id' => $id])) {
                    $success = 'تم حذف العمل بنجاح';
                    log_admin_activity($_SESSION['admin_id'], 'delete_portfolio', "Deleted portfolio item #$id");
                } else {
                    $error = 'حدث خطأ أثناء الحذف';
                }
                break;
        }
    }
}

// Get portfolio items
$portfolio_items = db_fetch_all("SELECT * FROM portfolio_items ORDER BY year DESC, created_at DESC");
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

<!-- Add New Button -->
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold">أعمالنا (<?php echo count($portfolio_items); ?>)</h2>
    <button onclick="showAddForm()" class="px-6 py-3 bg-primary hover:bg-primary-600 text-dark font-semibold rounded-lg transition-all duration-300 hover:shadow-xl">
        <i class="fas fa-plus ml-2"></i>
        إضافة عمل جديد
    </button>
</div>

<!-- Add Form (Hidden by default) -->
<div id="addForm" class="hidden mb-6 bg-dark-lighter rounded-xl border border-dark-light p-6">
    <h3 class="text-xl font-bold mb-4">إضافة عمل جديد</h3>
    <form method="POST" class="space-y-4">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <input type="hidden" name="action" value="add">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">عنوان المشروع *</label>
                <input type="text" name="title" required
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">اسم العميل *</label>
                <input type="text" name="client" required
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">الفئة</label>
                <select name="category"
                        class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
                    <option value="Graphic Design">Graphic Design</option>
                    <option value="Advertising">Advertising</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Branding">Branding</option>
                    <option value="Video">Video</option>
                    <option value="Social Media">Social Media</option>
                    <option value="Web Development">Web Development</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">السنة</label>
                <input type="number" name="year" value="<?php echo date('Y'); ?>" min="2000" max="<?php echo date('Y'); ?>"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">المدة</label>
                <input type="text" name="duration" placeholder="مثال: 3 أشهر"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">الخدمات</label>
                <input type="text" name="services" placeholder="مثال: تصميم، تطوير، تسويق"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">الوصف</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary"></textarea>
        </div>
        
        <div class="flex items-center">
            <input type="checkbox" name="featured" id="featured" class="w-4 h-4 text-primary bg-dark border-dark-light rounded">
            <label for="featured" class="mr-2 text-sm text-gray-300">مشروع مميز</label>
        </div>
        
        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary-600 text-dark font-semibold rounded-lg transition-colors">
                <i class="fas fa-save ml-2"></i>
                حفظ
            </button>
            <button type="button" onclick="hideAddForm()" class="px-6 py-3 bg-dark border border-dark-light text-gray-300 rounded-lg hover:bg-dark-light transition-colors">
                إلغاء
            </button>
        </div>
    </form>
</div>

<!-- Portfolio Items Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if (empty($portfolio_items)): ?>
        <div class="col-span-full p-12 text-center bg-dark-lighter rounded-xl border border-dark-light">
            <i class="fas fa-briefcase text-gray-600 text-6xl mb-4"></i>
            <p class="text-gray-400 text-lg">لا توجد أعمال</p>
            <button onclick="showAddForm()" class="mt-4 px-6 py-3 bg-primary hover:bg-primary-600 text-dark font-semibold rounded-lg transition-colors">
                إضافة عمل جديد
            </button>
        </div>
    <?php else: ?>
        <?php foreach ($portfolio_items as $item): ?>
        <div class="bg-dark-lighter rounded-xl border border-dark-light overflow-hidden hover:border-primary transition-colors">
            <div class="h-48 bg-gradient-to-br from-primary/20 to-accent-gold/20 flex items-center justify-center">
                <i class="fas fa-briefcase text-primary text-6xl"></i>
            </div>
            <div class="p-6">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="text-lg font-bold"><?php echo htmlspecialchars($item['title']); ?></h3>
                    <?php if ($item['featured']): ?>
                    <span class="px-2 py-1 text-xs rounded-full bg-primary/20 text-primary">مميز</span>
                    <?php endif; ?>
                </div>
                <p class="text-gray-400 text-sm mb-2"><?php echo htmlspecialchars($item['client']); ?></p>
                <p class="text-gray-500 text-xs mb-4"><?php echo htmlspecialchars($item['category']); ?> • <?php echo $item['year']; ?></p>
                
                <?php if ($item['description']): ?>
                <p class="text-gray-300 text-sm mb-4 line-clamp-2"><?php echo htmlspecialchars($item['description']); ?></p>
                <?php endif; ?>
                
                <div class="flex items-center space-x-2 space-x-reverse">
                    <form method="POST" class="flex-1">
                        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="portfolio_id" value="<?php echo $item['id']; ?>">
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-colors"
                                data-confirm="هل أنت متأكد من حذف هذا العمل؟">
                            <i class="fas fa-trash ml-2"></i>
                            حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
function showAddForm() {
    document.getElementById('addForm').classList.remove('hidden');
    document.getElementById('addForm').scrollIntoView({ behavior: 'smooth' });
}

function hideAddForm() {
    document.getElementById('addForm').classList.add('hidden');
}
</script>

<?php require_once 'footer.php'; ?>
