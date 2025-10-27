<?php
$page_title = 'إدارة الرسائل';
require_once 'header.php';

$success = '';
$error = '';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'رمز الأمان غير صحيح';
    } else {
        $action = $_POST['action'] ?? '';
        $message_id = (int)($_POST['message_id'] ?? 0);
        
        switch ($action) {
            case 'mark_read':
                if (db_update('contact_messages', ['is_read' => 1], 'id = :id', [':id' => $message_id])) {
                    $success = 'تم تحديد الرسالة كمقروءة';
                    log_admin_activity($_SESSION['admin_id'], 'mark_message_read', "Marked message #$message_id as read");
                }
                break;
                
            case 'mark_unread':
                if (db_update('contact_messages', ['is_read' => 0], 'id = :id', [':id' => $message_id])) {
                    $success = 'تم تحديد الرسالة كغير مقروءة';
                    log_admin_activity($_SESSION['admin_id'], 'mark_message_unread', "Marked message #$message_id as unread");
                }
                break;
                
            case 'delete':
                if (db_delete('contact_messages', 'id = :id', [':id' => $message_id])) {
                    $success = 'تم حذف الرسالة بنجاح';
                    log_admin_activity($_SESSION['admin_id'], 'delete_message', "Deleted message #$message_id");
                }
                break;
        }
    }
}

// Get filter
$filter = $_GET['filter'] ?? 'all';
$where = '1=1';
$params = [];

if ($filter === 'unread') {
    $where = 'is_read = 0';
} elseif ($filter === 'read') {
    $where = 'is_read = 1';
}

// Get messages
$messages = db_fetch_all("SELECT * FROM contact_messages WHERE $where ORDER BY created_at DESC", $params);
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

<!-- Filters -->
<div class="mb-6 flex items-center space-x-4 space-x-reverse">
    <a href="?filter=all" class="px-4 py-2 rounded-lg <?php echo $filter === 'all' ? 'bg-primary text-dark' : 'bg-dark-lighter text-gray-300 hover:bg-dark-light'; ?> transition-colors">
        الكل (<?php echo db_count('contact_messages'); ?>)
    </a>
    <a href="?filter=unread" class="px-4 py-2 rounded-lg <?php echo $filter === 'unread' ? 'bg-primary text-dark' : 'bg-dark-lighter text-gray-300 hover:bg-dark-light'; ?> transition-colors">
        غير مقروءة (<?php echo db_count('contact_messages', 'is_read = 0'); ?>)
    </a>
    <a href="?filter=read" class="px-4 py-2 rounded-lg <?php echo $filter === 'read' ? 'bg-primary text-dark' : 'bg-dark-lighter text-gray-300 hover:bg-dark-light'; ?> transition-colors">
        مقروءة (<?php echo db_count('contact_messages', 'is_read = 1'); ?>)
    </a>
</div>

<!-- Messages List -->
<div class="bg-dark-lighter rounded-xl border border-dark-light overflow-hidden">
    <?php if (empty($messages)): ?>
        <div class="p-12 text-center">
            <i class="fas fa-envelope text-gray-600 text-6xl mb-4"></i>
            <p class="text-gray-400 text-lg">لا توجد رسائل</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-dark border-b border-dark-light">
                    <tr>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-300">الاسم</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-300">البريد الإلكتروني</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-300">الرسالة</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-300">التاريخ</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-300">الحالة</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-300">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-light">
                    <?php foreach ($messages as $message): ?>
                    <tr class="<?php echo $message['is_read'] ? '' : 'bg-primary/5'; ?> hover:bg-dark-light transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <?php if (!$message['is_read']): ?>
                                <span class="w-2 h-2 rounded-full bg-primary ml-2"></span>
                                <?php endif; ?>
                                <span class="font-medium"><?php echo htmlspecialchars($message['name']); ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-300"><?php echo htmlspecialchars($message['email']); ?></td>
                        <td class="px-6 py-4">
                            <p class="text-gray-300 truncate max-w-md"><?php echo htmlspecialchars($message['message']); ?></p>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-sm"><?php echo date('Y-m-d H:i', strtotime($message['created_at'])); ?></td>
                        <td class="px-6 py-4">
                            <?php if ($message['is_read']): ?>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-500/20 text-green-400">مقروءة</span>
                            <?php else: ?>
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-500/20 text-yellow-400">جديدة</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2 space-x-reverse">
                                <!-- View Button -->
                                <button onclick="viewMessage(<?php echo htmlspecialchars(json_encode($message)); ?>)" 
                                        class="p-2 text-blue-400 hover:bg-blue-500/10 rounded transition-colors" 
                                        title="عرض">
                                    <i class="fas fa-eye"></i>
                                </button>
                                
                                <!-- Mark Read/Unread -->
                                <form method="POST" class="inline">
                                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                                    <input type="hidden" name="action" value="<?php echo $message['is_read'] ? 'mark_unread' : 'mark_read'; ?>">
                                    <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                    <button type="submit" 
                                            class="p-2 text-yellow-400 hover:bg-yellow-500/10 rounded transition-colors" 
                                            title="<?php echo $message['is_read'] ? 'تحديد كغير مقروءة' : 'تحديد كمقروءة'; ?>">
                                        <i class="fas fa-<?php echo $message['is_read'] ? 'envelope' : 'envelope-open'; ?>"></i>
                                    </button>
                                </form>
                                
                                <!-- Delete -->
                                <form method="POST" class="inline">
                                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                    <button type="submit" 
                                            class="p-2 text-red-400 hover:bg-red-500/10 rounded transition-colors" 
                                            data-confirm="هل أنت متأكد من حذف هذه الرسالة؟"
                                            title="حذف">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- View Message Modal -->
<div id="messageModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-dark-lighter rounded-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-dark-light flex items-center justify-between">
            <h3 class="text-xl font-bold">تفاصيل الرسالة</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-white">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <label class="text-sm text-gray-400">الاسم</label>
                <p id="modal-name" class="text-lg font-medium"></p>
            </div>
            <div>
                <label class="text-sm text-gray-400">البريد الإلكتروني</label>
                <p id="modal-email" class="text-lg"></p>
            </div>
            <div>
                <label class="text-sm text-gray-400">رقم الهاتف</label>
                <p id="modal-phone" class="text-lg"></p>
            </div>
            <div>
                <label class="text-sm text-gray-400">الموضوع</label>
                <p id="modal-subject" class="text-lg"></p>
            </div>
            <div>
                <label class="text-sm text-gray-400">الرسالة</label>
                <p id="modal-message" class="text-lg whitespace-pre-wrap"></p>
            </div>
            <div>
                <label class="text-sm text-gray-400">التاريخ</label>
                <p id="modal-date" class="text-lg"></p>
            </div>
        </div>
    </div>
</div>

<script>
function viewMessage(message) {
    document.getElementById('modal-name').textContent = message.name;
    document.getElementById('modal-email').textContent = message.email;
    document.getElementById('modal-phone').textContent = message.phone || 'غير متوفر';
    document.getElementById('modal-subject').textContent = message.subject || 'بدون موضوع';
    document.getElementById('modal-message').textContent = message.message;
    document.getElementById('modal-date').textContent = new Date(message.created_at).toLocaleString('ar-EG');
    
    document.getElementById('messageModal').classList.remove('hidden');
    document.getElementById('messageModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('messageModal').classList.add('hidden');
    document.getElementById('messageModal').classList.remove('flex');
}

// Close modal on outside click
document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>

<?php require_once 'footer.php'; ?>

