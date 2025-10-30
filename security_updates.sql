-- Security Updates SQL
-- This file contains database schema updates for security improvements

-- Create login_attempts table for rate limiting
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `success` tinyint(1) NOT NULL DEFAULT 0,
  `attempted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ip_address` (`ip_address`),
  KEY `attempted_at` (`attempted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Update contact_messages table to add new fields (if not exist)
ALTER TABLE `contact_messages`
ADD COLUMN IF NOT EXISTS `ip_address` varchar(45) DEFAULT NULL AFTER `message`,
ADD COLUMN IF NOT EXISTS `user_agent` text DEFAULT NULL AFTER `ip_address`;

-- Create index on contact_messages for better performance
ALTER TABLE `contact_messages`
ADD INDEX IF NOT EXISTS `idx_created_at` (`created_at`),
ADD INDEX IF NOT EXISTS `idx_is_read` (`is_read`);

-- Add remember_me token table for secure "Remember Me" functionality
CREATE TABLE IF NOT EXISTS `remember_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `user_id` (`user_id`),
  KEY `expires_at` (`expires_at`),
  CONSTRAINT `remember_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add index to admin_activity_log for better performance
ALTER TABLE `admin_activity_log`
ADD INDEX IF NOT EXISTS `idx_admin_id` (`admin_id`),
ADD INDEX IF NOT EXISTS `idx_action` (`action`),
ADD INDEX IF NOT EXISTS `idx_created_at` (`created_at`);

-- Update portfolio_items table to ensure proper indexes
ALTER TABLE `portfolio_items`
ADD INDEX IF NOT EXISTS `idx_category` (`category`),
ADD INDEX IF NOT EXISTS `idx_year` (`year`),
ADD INDEX IF NOT EXISTS `idx_featured` (`featured`),
ADD INDEX IF NOT EXISTS `idx_order_index` (`order_index`);
