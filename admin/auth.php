<?php
/**
 * Admin Authentication System
 */

session_start();

require_once __DIR__ . '/../db.php';

// Check if user is logged in
function is_admin_logged_in() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

// Require admin login
function require_admin_login() {
    if (!is_admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

// Get current admin user
function get_current_admin() {
    if (!is_admin_logged_in()) {
        return null;
    }
    
    return db_fetch_one(
        "SELECT id, username, email, full_name, role, last_login FROM admin_users WHERE id = :id",
        [':id' => $_SESSION['admin_id']]
    );
}

// Login admin
function admin_login($username, $password, $remember = false) {
    $user = db_fetch_one(
        "SELECT * FROM admin_users WHERE username = :username",
        [':username' => $username]
    );
    
    if ($user && password_verify($password, $user['password'])) {
        // Set session
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_role'] = $user['role'];
        
        // Update last login
        db_update('admin_users', 
            ['last_login' => date('Y-m-d H:i:s')],
            'id = :id',
            [':id' => $user['id']]
        );
        
        // Remember me
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            setcookie('admin_remember', $token, time() + (30 * 24 * 60 * 60), '/'); // 30 days
        }
        
        // Log activity
        log_admin_activity($user['id'], 'login', 'Admin logged in');
        
        return true;
    }
    
    return false;
}

// Logout admin
function admin_logout() {
    if (is_admin_logged_in()) {
        log_admin_activity($_SESSION['admin_id'], 'logout', 'Admin logged out');
    }
    
    session_destroy();
    setcookie('admin_remember', '', time() - 3600, '/');
    header('Location: login.php');
    exit;
}

// Log admin activity
function log_admin_activity($admin_id, $action, $description = null) {
    try {
        db_insert('admin_activity_log', [
            'admin_id' => $admin_id,
            'action' => $action,
            'description' => $description,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null
        ]);
    } catch (Exception $e) {
        error_log("Failed to log admin activity: " . $e->getMessage());
    }
}

// Generate CSRF token
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verify CSRF token
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Sanitize input
function sanitize_input($data) {
    if (is_array($data)) {
        return array_map('sanitize_input', $data);
    }
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}
?>
