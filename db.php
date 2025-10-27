<?php
/**
 * Database Connection
 */

// Database configuration
define('DB_HOST', getenv('DB_HOST') ?: 'qowwgg884444wkokkswggs84');
define('DB_NAME', getenv('DB_NAME') ?: 'pyramedia');
define('DB_USER', getenv('DB_USER') ?: 'mysql');
define('DB_PASS', getenv('DB_PASS') ?: 'fiSvKubF2P2hRa9H6eNZIoBaScNJDBc3W2QV34Imt4NbzOSPVQtvQjGowTljQ8v7');
define('DB_CHARSET', 'utf8mb4');

// Create connection
function get_db_connection() {
    static $conn = null;
    
    if ($conn === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection failed. Please try again later.");
        }
    }
    
    return $conn;
}

// Execute query
function db_query($sql, $params = []) {
    $conn = get_db_connection();
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

// Fetch all rows
function db_fetch_all($sql, $params = []) {
    $stmt = db_query($sql, $params);
    return $stmt->fetchAll();
}

// Fetch single row
function db_fetch_one($sql, $params = []) {
    $stmt = db_query($sql, $params);
    return $stmt->fetch();
}

// Insert and return last insert ID
function db_insert($table, $data) {
    $conn = get_db_connection();
    $fields = array_keys($data);
    $placeholders = array_map(function($field) { return ":$field"; }, $fields);
    
    $sql = "INSERT INTO $table (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $placeholders) . ")";
    $stmt = $conn->prepare($sql);
    
    foreach ($data as $field => $value) {
        $stmt->bindValue(":$field", $value);
    }
    
    $stmt->execute();
    return $conn->lastInsertId();
}

// Update
function db_update($table, $data, $where, $where_params = []) {
    $conn = get_db_connection();
    $set_parts = [];
    
    foreach (array_keys($data) as $field) {
        $set_parts[] = "$field = :$field";
    }
    
    $sql = "UPDATE $table SET " . implode(', ', $set_parts) . " WHERE $where";
    $stmt = $conn->prepare($sql);
    
    foreach ($data as $field => $value) {
        $stmt->bindValue(":$field", $value);
    }
    
    foreach ($where_params as $param => $value) {
        $stmt->bindValue($param, $value);
    }
    
    return $stmt->execute();
}

// Delete
function db_delete($table, $where, $params = []) {
    $sql = "DELETE FROM $table WHERE $where";
    $stmt = db_query($sql, $params);
    return $stmt->rowCount();
}

// Count
function db_count($table, $where = '1=1', $params = []) {
    $sql = "SELECT COUNT(*) as count FROM $table WHERE $where";
    $result = db_fetch_one($sql, $params);
    return $result['count'] ?? 0;
}
?>
