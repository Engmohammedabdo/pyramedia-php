<?php
/**
 * Image Upload Handler
 */

session_start();
require_once 'auth.php';
require_admin_login();

header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'file_path' => ''];

// Check if file was uploaded
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    $response['message'] = 'لم يتم رفع الملف بشكل صحيح';
    echo json_encode($response);
    exit;
}

$file = $_FILES['image'];
$allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$max_size = 5 * 1024 * 1024; // 5MB

// Validate file type
if (!in_array($file['type'], $allowed_types)) {
    $response['message'] = 'نوع الملف غير مدعوم. يرجى رفع صورة (JPG, PNG, GIF, WEBP)';
    echo json_encode($response);
    exit;
}

// Validate file size
if ($file['size'] > $max_size) {
    $response['message'] = 'حجم الملف كبير جداً. الحد الأقصى 5MB';
    echo json_encode($response);
    exit;
}

// Generate unique filename
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = 'portfolio_' . uniqid() . '_' . time() . '.' . $extension;
$upload_dir = __DIR__ . '/../uploads/portfolio/';
$upload_path = $upload_dir . $filename;

// Create directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Move uploaded file
if (move_uploaded_file($file['tmp_name'], $upload_path)) {
    // Resize image if needed (max 1200px width)
    resize_image($upload_path, 1200);
    
    $response['success'] = true;
    $response['message'] = 'تم رفع الصورة بنجاح';
    $response['file_path'] = '/uploads/portfolio/' . $filename;
    
    // Log activity
    log_admin_activity($_SESSION['admin_id'], 'upload_image', "Uploaded image: $filename");
} else {
    $response['message'] = 'فشل رفع الملف';
}

echo json_encode($response);

/**
 * Resize image to max width while maintaining aspect ratio
 */
function resize_image($file_path, $max_width) {
    $image_info = getimagesize($file_path);
    if (!$image_info) return false;
    
    list($width, $height, $type) = $image_info;
    
    // Skip if already smaller
    if ($width <= $max_width) return true;
    
    $new_width = $max_width;
    $new_height = ($height / $width) * $new_width;
    
    // Create image resource based on type
    switch ($type) {
        case IMAGETYPE_JPEG:
            $source = imagecreatefromjpeg($file_path);
            break;
        case IMAGETYPE_PNG:
            $source = imagecreatefrompng($file_path);
            break;
        case IMAGETYPE_GIF:
            $source = imagecreatefromgif($file_path);
            break;
        case IMAGETYPE_WEBP:
            $source = imagecreatefromwebp($file_path);
            break;
        default:
            return false;
    }
    
    // Create new image
    $new_image = imagecreatetruecolor($new_width, $new_height);
    
    // Preserve transparency for PNG and GIF
    if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
        imagefilledrectangle($new_image, 0, 0, $new_width, $new_height, $transparent);
    }
    
    // Resize
    imagecopyresampled($new_image, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    
    // Save based on type
    switch ($type) {
        case IMAGETYPE_JPEG:
            imagejpeg($new_image, $file_path, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($new_image, $file_path, 9);
            break;
        case IMAGETYPE_GIF:
            imagegif($new_image, $file_path);
            break;
        case IMAGETYPE_WEBP:
            imagewebp($new_image, $file_path, 90);
            break;
    }
    
    imagedestroy($source);
    imagedestroy($new_image);
    
    return true;
}
?>
