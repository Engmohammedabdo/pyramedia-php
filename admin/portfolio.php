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
                    'image' => sanitize_input($_POST['image'] ?? ''),
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
                
            case 'edit':
                $id = (int)($_POST['portfolio_id'] ?? 0);
                $data = [
                    'title' => sanitize_input($_POST['title'] ?? ''),
                    'client' => sanitize_input($_POST['client'] ?? ''),
                    'category' => sanitize_input($_POST['category'] ?? ''),
                    'description' => sanitize_input($_POST['description'] ?? ''),
                    'image' => sanitize_input($_POST['image'] ?? ''),
                    'services' => sanitize_input($_POST['services'] ?? ''),
                    'duration' => sanitize_input($_POST['duration'] ?? ''),
                    'year' => (int)($_POST['year'] ?? date('Y')),
                    'featured' => isset($_POST['featured']) ? 1 : 0,
                ];
                
                if (empty($data['title']) || empty($data['client'])) {
                    $error = 'يرجى إدخال العنوان واسم العميل';
                } else {
                    if (db_update('portfolio_items', $data, 'id = :id', [':id' => $id])) {
                        $success = 'تم تحديث العمل بنجاح';
                        log_admin_activity($_SESSION['admin_id'], 'edit_portfolio', "Edited portfolio item #$id: {$data['title']}");
                    } else {
                        $error = 'حدث خطأ أثناء التحديث';
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
        
        <!-- Image Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">صورة المشروع</label>
            <input type="hidden" name="image" id="add_image_path">
            <div class="flex items-center gap-4">
                <div id="add_image_preview" class="hidden w-32 h-32 rounded-lg border-2 border-dark-light overflow-hidden">
                    <img src="" alt="Preview" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <input type="file" id="add_image_input" accept="image/*" class="hidden">
                    <button type="button" onclick="document.getElementById('add_image_input').click()" 
                            class="px-4 py-2 bg-dark border border-dark-light text-gray-300 rounded-lg hover:border-primary transition-colors">
                        <i class="fas fa-upload ml-2"></i>
                        رفع صورة
                    </button>
                    <button type="button" id="add_remove_image" onclick="removeAddImage()" 
                            class="hidden px-4 py-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-colors">
                        <i class="fas fa-trash ml-2"></i>
                        حذف الصورة
                    </button>
                    <p class="text-xs text-gray-500 mt-2">الحد الأقصى: 5MB | الصيغ: JPG, PNG, GIF, WEBP</p>
                </div>
            </div>
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
                
                <div class="flex items-center gap-2">
                    <button onclick="showEditForm(<?php echo $item['id']; ?>)" 
                            class="flex-1 px-4 py-2 bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors">
                        <i class="fas fa-edit ml-2"></i>
                        تعديل
                    </button>
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

<!-- Edit Form (Hidden by default) -->
<div id="editForm" class="hidden mb-6 bg-dark-lighter rounded-xl border border-dark-light p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">تعديل العمل</h3>
        <button onclick="hideEditForm()" class="text-gray-400 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <form method="POST" class="space-y-4" id="editFormElement">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="portfolio_id" id="edit_portfolio_id">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">عنوان المشروع *</label>
                <input type="text" name="title" id="edit_title" required
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">اسم العميل *</label>
                <input type="text" name="client" id="edit_client" required
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">الفئة</label>
                <select name="category" id="edit_category"
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
                <input type="number" name="year" id="edit_year" min="2000" max="<?php echo date('Y'); ?>"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">المدة</label>
                <input type="text" name="duration" id="edit_duration" placeholder="مثال: 3 أشهر"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">الخدمات</label>
                <input type="text" name="services" id="edit_services" placeholder="مثال: تصميم، تطوير، تسويق"
                       class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary">
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">الوصف</label>
            <textarea name="description" id="edit_description" rows="4"
                      class="w-full px-4 py-3 bg-dark border border-dark-light rounded-lg text-white focus:outline-none focus:border-primary"></textarea>
        </div>
        
        <!-- Image Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">صورة المشروع</label>
            <input type="hidden" name="image" id="edit_image_path">
            <div class="flex items-center gap-4">
                <div id="edit_image_preview" class="hidden w-32 h-32 rounded-lg border-2 border-dark-light overflow-hidden">
                    <img src="" alt="Preview" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <input type="file" id="edit_image_input" accept="image/*" class="hidden">
                    <button type="button" onclick="document.getElementById('edit_image_input').click()" 
                            class="px-4 py-2 bg-dark border border-dark-light text-gray-300 rounded-lg hover:border-primary transition-colors">
                        <i class="fas fa-upload ml-2"></i>
                        رفع صورة
                    </button>
                    <button type="button" id="edit_remove_image" onclick="removeEditImage()" 
                            class="hidden px-4 py-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-colors">
                        <i class="fas fa-trash ml-2"></i>
                        حذف الصورة
                    </button>
                    <p class="text-xs text-gray-500 mt-2">الحد الأقصى: 5MB | الصيغ: JPG, PNG, GIF, WEBP</p>
                </div>
            </div>
        </div>
        
        <div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="featured" id="edit_featured" class="w-5 h-5 rounded bg-dark border-dark-light text-primary focus:ring-primary">
                <span class="text-gray-300">عمل مميز</span>
            </label>
        </div>
        
        <div class="flex gap-4">
            <button type="submit" class="flex-1 px-6 py-3 bg-primary hover:bg-primary-600 text-dark font-semibold rounded-lg transition-all">
                <i class="fas fa-save ml-2"></i>
                حفظ التغييرات
            </button>
            <button type="button" onclick="hideEditForm()" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg transition-all">
                إلغاء
            </button>
        </div>
    </form>
</div>

<script>
// Portfolio items data for JavaScript
const portfolioData = <?php echo json_encode($portfolio_items); ?>;

function showAddForm() {
    document.getElementById('addForm').classList.remove('hidden');
    document.getElementById('addForm').scrollIntoView({ behavior: 'smooth' });
}

function hideAddForm() {
    document.getElementById('addForm').classList.add('hidden');
}

function showEditForm(id) {
    // Find the portfolio item
    const item = portfolioData.find(p => p.id == id);
    if (!item) return;
    
    // Fill the form
    document.getElementById('edit_portfolio_id').value = item.id;
    document.getElementById('edit_title').value = item.title || '';
    document.getElementById('edit_client').value = item.client || '';
    document.getElementById('edit_category').value = item.category || '';
    document.getElementById('edit_year').value = item.year || new Date().getFullYear();
    document.getElementById('edit_duration').value = item.duration || '';
    document.getElementById('edit_services').value = item.services || '';
    document.getElementById('edit_description').value = item.description || '';
    document.getElementById('edit_featured').checked = item.featured == 1;
    
    // Handle image
    if (item.image) {
        document.getElementById('edit_image_path').value = item.image;
        const preview = document.getElementById('edit_image_preview');
        preview.querySelector('img').src = item.image;
        preview.classList.remove('hidden');
        document.getElementById('edit_remove_image').classList.remove('hidden');
    } else {
        removeEditImage();
    }
    
    // Show the form
    document.getElementById('editForm').classList.remove('hidden');
    document.getElementById('editForm').scrollIntoView({ behavior: 'smooth' });
}

function hideEditForm() {
    document.getElementById('editForm').classList.add('hidden');
}

// Image upload handlers
document.getElementById('add_image_input').addEventListener('change', function(e) {
    uploadImage(e.target.files[0], 'add');
});

document.getElementById('edit_image_input').addEventListener('change', function(e) {
    uploadImage(e.target.files[0], 'edit');
});

function uploadImage(file, formType) {
    if (!file) return;
    
    const formData = new FormData();
    formData.append('image', file);
    
    // Show loading
    const btn = document.querySelector(`#${formType}_image_input + button`);
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin ml-2"></i> جاري الرفع...';
    btn.disabled = true;
    
    fetch('upload_image.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Set image path
            document.getElementById(`${formType}_image_path`).value = data.file_path;
            
            // Show preview
            const preview = document.getElementById(`${formType}_image_preview`);
            preview.querySelector('img').src = data.file_path;
            preview.classList.remove('hidden');
            
            // Show remove button
            document.getElementById(`${formType}_remove_image`).classList.remove('hidden');
        } else {
            alert('خطأ: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء رفع الصورة');
    })
    .finally(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

function removeAddImage() {
    document.getElementById('add_image_path').value = '';
    document.getElementById('add_image_preview').classList.add('hidden');
    document.getElementById('add_remove_image').classList.add('hidden');
    document.getElementById('add_image_input').value = '';
}

function removeEditImage() {
    document.getElementById('edit_image_path').value = '';
    document.getElementById('edit_image_preview').classList.add('hidden');
    document.getElementById('edit_remove_image').classList.add('hidden');
    document.getElementById('edit_image_input').value = '';
}
</script>

<?php require_once 'footer.php'; ?>
