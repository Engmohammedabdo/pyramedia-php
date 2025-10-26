# Pyramedia Admin Setup Guide

## 📋 Requirements

- PHP 7.4+
- MySQL 5.7+
- Apache/Nginx with mod_rewrite

## 🗄️ Database Setup

### Step 1: Create Database

```sql
CREATE DATABASE pyramedia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 2: Import Schema

```bash
mysql -u your_username -p pyramedia < database.sql
```

Or using phpMyAdmin:
1. Open phpMyAdmin
2. Select `pyramedia` database
3. Go to "Import" tab
4. Choose `database.sql` file
5. Click "Go"

## 🔐 Default Admin Credentials

**Username:** `admin`  
**Password:** `admin123`

⚠️ **IMPORTANT:** Change the default password immediately after first login!

## ⚙️ Environment Configuration

### Database Connection

Update `db.php` or set environment variables:

```bash
DB_HOST=localhost
DB_NAME=pyramedia
DB_USER=your_username
DB_PASS=your_password
```

### Coolify Environment Variables

In Coolify Dashboard, add these environment variables:

```
DB_HOST=mysql_container_name
DB_NAME=pyramedia
DB_USER=pyramedia_user
DB_PASS=your_secure_password
```

## 📁 Admin Features (Implemented)

✅ **Authentication System**
- Secure login with password hashing
- Session management
- Remember me functionality
- CSRF protection

✅ **Database Schema**
- Admin users table
- Portfolio items table
- Contact messages table
- Services table
- Site settings table
- Activity log table

## 🚀 Admin Features (To Be Implemented)

### Dashboard
- [ ] Statistics overview
- [ ] Quick actions
- [ ] Recent activity

### Portfolio Management
- [ ] List all portfolio items
- [ ] Add new portfolio item
- [ ] Edit portfolio item
- [ ] Delete portfolio item
- [ ] Upload images
- [ ] Bulk actions

### Services Management
- [ ] List all services
- [ ] Edit service content
- [ ] Toggle service visibility
- [ ] Reorder services

### Messages Management
- [ ] View contact form messages
- [ ] Mark as read/unread
- [ ] Delete messages
- [ ] Reply to messages
- [ ] Export messages

### Settings
- [ ] Site information
- [ ] Contact details
- [ ] Social media links
- [ ] SEO settings
- [ ] Logo upload

## 🔒 Security Features

✅ **Implemented:**
- Password hashing (bcrypt)
- SQL injection prevention (PDO prepared statements)
- XSS protection (htmlspecialchars)
- CSRF token generation
- Session security

⏳ **To Be Implemented:**
- File upload validation
- Rate limiting
- Two-factor authentication
- IP whitelist

## 📝 Admin URLs

- **Login:** `/admin/login.php`
- **Dashboard:** `/admin/index.php` (to be created)
- **Portfolio:** `/admin/portfolio.php` (to be created)
- **Messages:** `/admin/messages.php` (to be created)
- **Settings:** `/admin/settings.php` (to be created)

## 🛠️ Troubleshooting

### Database Connection Error

1. Check database credentials in `db.php`
2. Ensure MySQL service is running
3. Verify database exists
4. Check user permissions

### Login Not Working

1. Ensure `database.sql` was imported successfully
2. Check `admin_users` table exists
3. Verify default admin user was created
4. Clear browser cookies and try again

### Session Issues

1. Ensure PHP session is enabled
2. Check session directory permissions
3. Verify `session_start()` is called

## 📞 Support

For issues or questions:
- Email: info@pyramedia.ae
- GitHub: https://github.com/Engmohammedabdo/pyramedia-php

---

**Last Updated:** October 25, 2025

