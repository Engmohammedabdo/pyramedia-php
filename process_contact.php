<?php
/**
 * Contact Form Processing
 * 
 * معالجة نموذج التواصل وحفظ الرسائل في قاعدة البيانات
 */

require_once 'config.php';

// Set JSON response header
header('Content-Type: application/json');

// Initialize response
$response = [
    'success' => false,
    'message' => ''
];

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'طريقة الطلب غير صحيحة';
    echo json_encode($response);
    exit;
}

// Get and sanitize input data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$subject = trim($_POST['service'] ?? 'استفسار عام');
$message = trim($_POST['message'] ?? '');

// Validation
$errors = [];

if (empty($name)) {
    $errors[] = 'الاسم مطلوب';
}

if (empty($email)) {
    $errors[] = 'البريد الإلكتروني مطلوب';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'البريد الإلكتروني غير صحيح';
}

if (empty($message)) {
    $errors[] = 'الرسالة مطلوبة';
}

// Check for errors
if (!empty($errors)) {
    $response['message'] = implode('<br>', $errors);
    echo json_encode($response);
    exit;
}

// Simple honeypot spam protection
$honeypot = $_POST['website'] ?? '';
if (!empty($honeypot)) {
    // This is likely spam
    $response['success'] = true; // Pretend success to fool bots
    $response['message'] = 'شكراً لك! تم إرسال رسالتك بنجاح.';
    echo json_encode($response);
    exit;
}

// Try to save to database
try {
    $conn = get_db_connection();
    
    $stmt = $conn->prepare("INSERT INTO contact_messages 
        (name, email, phone, subject, message, status, created_at) 
        VALUES (:name, :email, :phone, :subject, :message, 'unread', NOW())");
    
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':subject' => $subject,
        ':message' => $message
    ]);
    
    $message_id = $conn->lastInsertId();
    
    // Try to send email notification (optional)
    try {
        send_contact_notification($name, $email, $phone, $subject, $message);
    } catch (Exception $e) {
        // Log email error but don't fail the request
        error_log("Email notification failed: " . $e->getMessage());
    }
    
    $response['success'] = true;
    $response['message'] = 'شكراً لك! تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.';
    $response['message_id'] = $message_id;
    
} catch (Exception $e) {
    error_log("Contact form error: " . $e->getMessage());
    $response['message'] = 'عذراً، حدث خطأ أثناء إرسال رسالتك. الرجاء المحاولة مرة أخرى أو التواصل معنا مباشرة.';
}

echo json_encode($response);

/**
 * Send email notification to admin
 */
function send_contact_notification($name, $email, $phone, $subject, $message) {
    $to = CONTACT_EMAIL;
    $email_subject = "رسالة جديدة من موقع Pyramedia: $subject";
    
    $email_body = "
    <html dir='rtl'>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: #667eea; color: white; padding: 20px; text-align: center; }
            .content { background: #f4f4f4; padding: 20px; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #667eea; }
            .value { margin-top: 5px; }
            .footer { text-align: center; padding: 20px; font-size: 12px; color: #999; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>رسالة جديدة من موقع Pyramedia</h2>
            </div>
            <div class='content'>
                <div class='field'>
                    <div class='label'>الاسم:</div>
                    <div class='value'>$name</div>
                </div>
                <div class='field'>
                    <div class='label'>البريد الإلكتروني:</div>
                    <div class='value'>$email</div>
                </div>
                <div class='field'>
                    <div class='label'>الهاتف:</div>
                    <div class='value'>$phone</div>
                </div>
                <div class='field'>
                    <div class='label'>الموضوع:</div>
                    <div class='value'>$subject</div>
                </div>
                <div class='field'>
                    <div class='label'>الرسالة:</div>
                    <div class='value'>" . nl2br(htmlspecialchars($message)) . "</div>
                </div>
            </div>
            <div class='footer'>
                <p>تم إرسال هذه الرسالة من نموذج التواصل في موقع Pyramedia</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $email,
        'Reply-To: ' . $email,
        'X-Mailer: PHP/' . phpversion()
    ];
    
    return mail($to, $email_subject, $email_body, implode("\r\n", $headers));
}
?>
