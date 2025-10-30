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

    // Check session timeout
    if (!check_session_timeout()) {
        header('Location: login.php?timeout=1');
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
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    $user = db_fetch_one(
        "SELECT * FROM admin_users WHERE username = :username",
        [':username' => $username]
    );

    if ($user && password_verify($password, $user['password'])) {
        // Set session
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_role'] = $user['role'];
        $_SESSION['last_activity'] = time();

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

        // Record successful login attempt
        record_login_attempt($ip_address, $username, true);

        return true;
    }

    // Record failed login attempt
    record_login_attempt($ip_address, $username, false);

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

// Rate limiting for login attempts
function check_login_rate_limit($ip_address) {
    $max_attempts = getenv('MAX_LOGIN_ATTEMPTS') ?: 5;
    $lockout_duration = getenv('LOGIN_LOCKOUT_DURATION') ?: 900; // 15 minutes in seconds

    try {
        // Clean up old attempts
        db_query("DELETE FROM login_attempts WHERE attempted_at < DATE_SUB(NOW(), INTERVAL ? SECOND)", [$lockout_duration]);

        // Count recent attempts from this IP
        $result = db_fetch_one(
            "SELECT COUNT(*) as attempt_count FROM login_attempts WHERE ip_address = ? AND attempted_at > DATE_SUB(NOW(), INTERVAL ? SECOND)",
            [$ip_address, $lockout_duration]
        );

        $attempt_count = $result['attempt_count'] ?? 0;

        if ($attempt_count >= $max_attempts) {
            return [
                'allowed' => false,
                'message' => 'تم تجاوز الحد الأقصى لمحاولات تسجيل الدخول. يرجى المحاولة بعد 15 دقيقة.',
                'attempts_left' => 0
            ];
        }

        return [
            'allowed' => true,
            'attempts_left' => $max_attempts - $attempt_count
        ];
    } catch (Exception $e) {
        error_log("Rate limit check error: " . $e->getMessage());
        // Allow login on error to prevent lockout due to technical issues
        return ['allowed' => true, 'attempts_left' => $max_attempts];
    }
}

// Record failed login attempt
function record_login_attempt($ip_address, $username, $success = false) {
    try {
        db_insert('login_attempts', [
            'ip_address' => $ip_address,
            'username' => $username,
            'success' => $success ? 1 : 0
        ]);

        // If successful, clear previous failed attempts from this IP
        if ($success) {
            db_query("DELETE FROM login_attempts WHERE ip_address = ? AND success = 0", [$ip_address]);
        }
    } catch (Exception $e) {
        error_log("Failed to record login attempt: " . $e->getMessage());
    }
}

// Check session timeout
function check_session_timeout() {
    $timeout = getenv('ADMIN_SESSION_TIMEOUT') ?: 1800; // 30 minutes default

    if (isset($_SESSION['last_activity'])) {
        $inactive_time = time() - $_SESSION['last_activity'];

        if ($inactive_time > $timeout) {
            if (isset($_SESSION['admin_id'])) {
                log_admin_activity($_SESSION['admin_id'], 'session_timeout', 'Session expired due to inactivity');
            }
            session_unset();
            session_destroy();
            return false;
        }
    }

    $_SESSION['last_activity'] = time();
    return true;
}
?>
