# PRINTINGG NOVA - Deployment Guide

Complete guide for deploying PRINTINGG NOVA e-commerce website to production.

## Pre-Deployment Checklist

- [ ] All features tested locally
- [ ] Admin credentials changed
- [ ] Environment variables configured
- [ ] Database backup created
- [ ] SSL certificate obtained
- [ ] Domain configured
- [ ] Email service configured
- [ ] CDN setup (optional)
- [ ] Analytics tracking added
- [ ] Performance optimizations completed

## Deployment Steps

### 1. Server Preparation

#### Requirements
```
- PHP 8.1 or higher
- MySQL 8.0+
- Apache or Nginx with mod_rewrite enabled
- Composer installed
- Git installed (for deployment)
- At least 1GB RAM
- 5GB disk space
```

#### Create User & Directories
```bash
# SSH into server
ssh user@yourdomain.com

# Create application directory
mkdir -p /var/www/printingnova
cd /var/www/printingnova

# Set proper permissions
sudo chown -R www-data:www-data /var/www/printingnova
sudo chmod -R 755 /var/www/printingnova
```

### 2. Clone Application

```bash
# Clone from git repository (if using version control)
git clone https://github.com/yourusername/printingnova.git .

# Or upload files via SFTP/FTP
# Or use deployment tools (GitHub Actions, GitLab CI, etc.)
```

### 3. Install Dependencies

```bash
# Navigate to application directory
cd /var/www/printingnova

# Install composer dependencies
composer install --optimize-autoloader --no-dev

# Install npm dependencies (if using webpack)
npm install --production
```

### 4. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Edit environment file with production values
nano .env
```

#### .env Configuration Template
```env
APP_NAME="PRINTINGG NOVA"
APP_ENV=production
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=printingnova
DB_USERNAME=dbuser
DB_PASSWORD=strongpassword

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_email@example.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="PRINTINGG NOVA"

SESSION_DRIVER=cookie
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

FILESYSTEM_DISK=public
```

### 5. Database Setup

```bash
# Create database
mysql -u root -p
CREATE DATABASE printingnova CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'dbuser'@'localhost' IDENTIFIED BY 'strongpassword';
GRANT ALL PRIVILEGES ON printingnova.* TO 'dbuser'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# Run migrations
php artisan migrate --force

# Seed admin user
php artisan db:seed --class=AdminUserSeeder

# Update admin credentials
php artisan tinker
> \App\Models\User::where('role', 'admin')->first()->update([
>   'email' => 'your-admin@yourdomain.com',
>   'password' => bcrypt('your-strong-password')
> ])
> exit
```

### 6. File Permissions

```bash
# Storage and bootstrap cache directories
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Public directory
sudo chmod -R 755 public

# Create storage symlink
php artisan storage:link
```

### 7. Web Server Configuration

#### Apache Configuration
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    ServerAdmin admin@yourdomain.com

    DocumentRoot /var/www/printingnova/public

    <Directory /var/www/printingnova>
        AllowOverride All
        Require all granted
    </Directory>

    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ index.php [QSA,L]
    </IfModule>

    ErrorLog ${APACHE_LOG_DIR}/printingnova-error.log
    CustomLog ${APACHE_LOG_DIR}/printingnova-access.log combined
</VirtualHost>

# Redirect HTTP to HTTPS
<VirtualHost *:443>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    ServerAdmin admin@yourdomain.com

    DocumentRoot /var/www/printingnova/public

    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
    SSLCertificateChainFile /path/to/chain.crt

    <Directory /var/www/printingnova>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/printingnova-error.log
    CustomLog ${APACHE_LOG_DIR}/printingnova-access.log combined
</VirtualHost>
```

#### Nginx Configuration
```nginx
server {
    listen 443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;

    root /var/www/printingnova/public;
    index index.php;

    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;

    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;

    client_max_body_size 100M;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }

    access_log /var/log/nginx/printingnova-access.log;
    error_log /var/log/nginx/printingnova-error.log;
}

# Redirect HTTP to HTTPS
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$server_name$request_uri;
}
```

### 8. SSL Certificate Installation

```bash
# Using Let's Encrypt with Certbot
sudo apt-get install certbot python3-certbot-apache

# For Apache
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com

# For Nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal
sudo systemctl enable certbot.timer
sudo systemctl start certbot.timer
```

### 9. Build Assets (if needed)

```bash
# If using Vite for frontend compilation
npm run build

# Or using Laravel Mix
npm run production
```

### 10. Optimize Application

```bash
# Cache configuration
php artisan config:cache

# Route caching
php artisan route:cache

# View caching
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev

# Clear all cache
php artisan cache:clear
```

### 11. Set Up Cron Scheduler (Optional)

```bash
# Edit crontab
sudo crontab -e

# Add this line to run Laravel scheduler every minute
* * * * * cd /var/www/printingnova && php artisan schedule:run >> /dev/null 2>&1
```

### 12. Set Up Queue Workers (Optional)

If you want to process emails and notifications in background:

```bash
# Create supervisor configuration
sudo nano /etc/supervisor/conf.d/printingnova-queue.conf
```

```ini
[program:printingnova-queue]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/printingnova/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
numprocs=4
redirect_stderr=true
stdout_logfile=/var/log/printingnova-queue.log
user=www-data
```

```bash
# Update supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start printingnova-queue:*
```

## Post-Deployment Configuration

### 1. Admin Panel Access

Update admin credentials immediately:
```bash
php artisan tinker
> $admin = \App\Models\User::where('role', 'admin')->first();
> $admin->update(['email' => 'youremail@yourdomain.com', 'password' => bcrypt('newpassword')])
> exit
```

Admin panel: `https://yourdomain.com/admin/login`

### 2. Email Configuration

Edit `.env` with your email provider credentials:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=app-specific-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

### 3. Configure Amazon S3 (Optional - for image storage)

```env
FILESYSTEM_DISK=s3

AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket
AWS_URL=https://your-bucket.s3.amazonaws.com
```

### 4. Set Up Monitoring

```bash
# Monitor error logs
tail -f storage/logs/laravel.log

# Monitor application performance
# Use tools like: New Relic, Datadog, Scout, or Sentry
```

## Backup & Maintenance

### Daily Backups

```bash
# Create backup script at /home/user/backups/backup.sh
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/home/user/backups"

# Database backup
mysqldump -u dbuser -p'password' printingnova > $BACKUP_DIR/database_$DATE.sql

# Application files backup
tar -czf $BACKUP_DIR/app_$DATE.tar.gz /var/www/printingnova

# Keep last 30 days of backups
find $BACKUP_DIR -name "*.tar.gz" -mtime +30 -delete
find $BACKUP_DIR -name "*.sql" -mtime +30 -delete

echo "Backup completed: $DATE"
```

### Add to Crontab

```bash
sudo crontab -e

# Add: Run backup daily at 2 AM
0 2 * * * /home/user/backups/backup.sh >> /home/user/backups/backup.log 2>&1
```

## Monitoring & Security

### Security Headers (Nginx)

```nginx
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header Referrer-Policy "no-referrer-when-downgrade" always;
```

### WordPress-style Security (Optional)

```bash
# Disable directory listing
a2enmod mod_dir

# Hide PHP version
# Edit /etc/php/8.1/apache2/php.ini
expose_php = Off

# Restart Apache
sudo systemctl restart apache2
```

### Monitor Server Health

```bash
# Check disk space
df -h

# Check memory usage
free -h

# Check CPU usage
top

# Check PHP-FPM status (if using Nginx)
sudo systemctl status php8.1-fpm
```

## Troubleshooting Deployment Issues

### Issue: 500 Internal Server Error

```bash
# Check error logs
tail -f /var/log/apache2/printingnova-error.log
# or for Nginx
tail -f /var/log/nginx/printingnova-error.log

# Check Laravel logs
tail -f /var/www/printingnova/storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Issue: Database Connection Error

```bash
# Test database connection
php artisan tinker
> DB::connection()->getPDO();

# Check credentials in .env
cat /var/www/printingnova/.env | grep DB_
```

### Issue: Permission Denied

```bash
# Reset permissions
sudo chown -R www-data:www-data /var/www/printingnova
sudo chmod -R 755 /var/www/printingnova
sudo chmod -R 775 storage bootstrap/cache
```

### Issue: Slow Page Load

```bash
# Cache routes and config
php artisan route:cache
php artisan config:cache

# Enable query caching
# Check database indexes
# Use CDN for static assets
```

## Performance Optimization

### Database Optimization

```bash
# Analyze and optimize tables
php artisan tinker
> DB::select('OPTIMIZE TABLE users, products, orders, categories, order_items, reviews, pages')
> exit
```

### PHP-FPM Optimization (Nginx)

Edit `/etc/php/8.1/fpm/pool.d/www.conf`:

```ini
pm = dynamic
pm.max_children = 20
pm.start_servers = 5
pm.min_spare_servers = 2
pm.max_spare_servers = 10
pm.max_requests = 500
```

### Enable Gzip Compression

```nginx
gzip on;
gzip_vary on;
gzip_proxied any;
gzip_comp_level 6;
gzip_types text/plain text/css text/xml text/javascript application/json application/javascript application/xml+rss;
```

## Rollback Procedure

```bash
# If deployment fails, rollback to previous version
cd /var/www/printingnova

# Revert code
git revert HEAD

# Clear cache
php artisan cache:clear
php artisan route:cache

# If database migrations caused issues
php artisan migrate:rollback
```

## Post-Launch Checklist

- [ ] Admin login working
- [ ] Products displaying correctly
- [ ] Shopping cart functional
- [ ] Checkout process working
- [ ] Email notifications sending
- [ ] SSL certificate active
- [ ] Redirects working (HTTP → HTTPS)
- [ ] Analytics tracking
- [ ] Sitemap generated
- [ ] robots.txt configured
- [ ] Backup system working
- [ ] Monitoring active
- [ ] Performance acceptable
- [ ] Security scan passed

---

## Support

For deployment issues or questions:
- Check Laravel documentation: https://laravel.com/docs
- Review error logs in `storage/logs/laravel.log`
- Contact hosting provider support team

---

**Last Updated**: January 27, 2026  
**Version**: 1.0.0
