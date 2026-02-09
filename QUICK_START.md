# PRINTINGG NOVA - Quick Start Guide

Fast setup and launch guide for the e-commerce platform.

## 🚀 Quick Start (5 Minutes)

### Step 1: Navigate to Project
```bash
cd c:\Users\satyam\Animationp_pvr
```

### Step 2: Start Development Server
```bash
php artisan serve
```

Server will run at: **http://localhost:8000**

### Step 3: Access Application

**Frontend** (Customers):
```
http://localhost:8000/
```

**Admin Panel** (Admin Login):
```
http://localhost:8000/admin/login
```

### Step 4: Login Credentials

```
Email: admin@example.com
Password: password
```

---

## 📋 What's Included

✅ **Admin Dashboard**
- Order statistics and tracking
- Product management (add, edit, delete)
- Category management
- Dynamic page creation
- Customer order management

✅ **Frontend Features**
- Product browsing and filtering
- Shopping cart
- Checkout process
- Order confirmation
- Contact form
- About page

✅ **Database**
- MySQL with 8 models
- Pre-configured relationships
- Sample admin user included

---

## 🛠️ First-Time Setup (If Starting Fresh)

### If Database Not Set Up

```bash
# 1. Create database and user (MySQL)
mysql -u root -p
CREATE DATABASE animation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'root'@'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON animation.* TO 'root'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# 2. Run migrations
php artisan migrate

# 3. Seed admin user
php artisan db:seed --class=AdminUserSeeder

# 4. Start server
php artisan serve
```

### If Dependencies Not Installed

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies (if needed)
npm install

# Generate app key
php artisan key:generate
```

---

## 📁 Key Files & Folders

| Location | Purpose |
|----------|---------|
| `app/Http/Controllers/Admin/` | Admin panel controllers |
| `app/Models/` | Database models |
| `resources/views/admin/` | Admin panel templates |
| `resources/views/` | Frontend templates |
| `routes/web.php` | Application routes |
| `database/migrations/` | Database schema |
| `storage/logs/laravel.log` | Application logs |

---

## 🔐 Security Tips

1. **Change Admin Password** (BEFORE delivery)
   ```bash
   php artisan tinker
   > \App\Models\User::where('email', 'admin@example.com')->first()->update(['password' => bcrypt('newpassword')])
   > exit
   ```

2. **Update .env File** (For production)
   ```
   APP_ENV=production
   APP_DEBUG=false
   ```

3. **Enable HTTPS** (For production)
   - Get SSL certificate
   - Configure web server (Apache/Nginx)

---

## 📊 Admin Panel Overview

### Dashboard
- View key metrics (orders, products, categories, revenue)
- See recent orders
- Track top products

### Products
- **Create**: Add new products with images
- **List**: View all products with search
- **Edit**: Update product details
- **Delete**: Remove products

### Categories
- Organize products by category
- Manage category images
- Track product counts

### Orders
- View customer orders
- Update order status
- Track shipping
- Update payment status

### Pages
- Create dynamic pages (About, Contact, etc.)
- Manage SEO meta tags
- Control page visibility

---

## 🛒 Customer Features

### Browse Products
1. Go to http://localhost:8000/products
2. Filter by category or search
3. Sort by price or newest
4. Click product for details

### Add to Cart
1. Select quantity
2. Click "Add to Cart"
3. View updated cart count in navbar

### Checkout
1. Click Cart icon → "Proceed to Checkout"
2. Fill billing address
3. Set shipping address
4. Select payment method
5. Review and submit order
6. Get order confirmation

---

## 🔧 Common Tasks

### View Logs
```bash
tail -f storage/logs/laravel.log
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Reset Database
```bash
php artisan migrate:fresh
php artisan db:seed --class=AdminUserSeeder
```

### Create Test Admin User
```bash
php artisan tinker
> \App\Models\User::create([
>   'name' => 'New Admin',
>   'email' => 'admin2@example.com',
>   'password' => bcrypt('password'),
>   'role' => 'admin'
> ])
> exit
```

### Backup Database
```bash
mysqldump -u root -p animation > backup.sql
```

---

## 🐛 Troubleshooting

### Issue: "Port 8000 already in use"
```bash
# Use different port
php artisan serve --port=8001
```

### Issue: "Database connection refused"
```bash
# Check MySQL is running and credentials in .env are correct
# Verify database name matches in .env file
php artisan tinker
> DB::connection()->getPDO();
```

### Issue: "No such file or directory" (migrations)
```bash
# Ensure you're in project root
cd c:\Users\satyam\Animationp_pvr
php artisan migrate
```

### Issue: Blank page / 500 error
```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear

# Verify file permissions
# Make sure storage/ and bootstrap/cache/ are writable
```

---

## 📚 Documentation Files

Read these for more details:

1. **PROJECT_DOCUMENTATION.md** - Complete feature documentation
2. **DEPLOYMENT_GUIDE.md** - Production deployment steps
3. **TESTING_GUIDE.md** - Comprehensive testing procedures

---

## 🎯 Next Steps

### For Development
```
1. Customize styling in views/
2. Add more product categories
3. Create sample products
4. Add images to products
5. Test checkout process
6. Create additional pages
```

### Before Client Delivery
```
1. ✅ Change admin password
2. ✅ Test all features (use TESTING_GUIDE.md)
3. ✅ Add sample products
4. ✅ Add company logo
5. ✅ Customize "About" page
6. ✅ Set contact email
7. ✅ Review all styling
8. ✅ Test on mobile
9. ✅ Backup database
10. ✅ Document credentials for client
```

### For Production Deployment
```
1. Follow DEPLOYMENT_GUIDE.md
2. Set up SSL certificate
3. Configure email service
4. Set up backups
5. Monitor performance
6. Set up security headers
```

---

## 💡 Tips & Tricks

### Create Multiple Admin Users
```bash
php artisan tinker
> \App\Models\User::create([
>   'name' => 'Manager Name',
>   'email' => 'manager@company.com',
>   'password' => bcrypt('secure-password'),
>   'role' => 'admin'
> ])
```

### Bulk Create Customer Accounts
```bash
php artisan tinker
> for($i=1; $i<=10; $i++) {
>   \App\Models\User::create([
>     'name' => "Customer $i",
>     'email' => "customer$i@example.com",
>     'password' => bcrypt('password'),
>     'role' => 'customer'
>   ]);
> }
```

### Query Database Directly
```bash
php artisan tinker

# Get all products
> \App\Models\Product::all()

# Count orders
> \App\Models\Order::count()

# Get admin users
> \App\Models\User::where('role', 'admin')->get()

# Exit tinker
> exit
```

---

## 📞 Support Contact

For issues or questions:
- Email: info@printingnova.com
- Phone: +91 97809 93395

---

## 🔗 Quick Links

| Function | URL |
|----------|-----|
| Home | http://localhost:8000/ |
| Products | http://localhost:8000/products |
| About | http://localhost:8000/about |
| Contact | http://localhost:8000/contact |
| Cart | http://localhost:8000/cart |
| Admin Login | http://localhost:8000/admin/login |
| Admin Dashboard | http://localhost:8000/admin/dashboard |
| Admin Products | http://localhost:8000/admin/products |
| Admin Categories | http://localhost:8000/admin/categories |
| Admin Orders | http://localhost:8000/admin/orders |
| Admin Pages | http://localhost:8000/admin/pages |

---

## ⚡ Performance Tips

1. **Enable Query Caching** (for production)
   ```bash
   php artisan config:cache
   php artisan route:cache
   ```

2. **Optimize Database** (periodically)
   ```bash
   # In tinker or MySQL
   OPTIMIZE TABLE users, products, categories, orders;
   ```

3. **Use CDN for Images** (production)
   - Move product images to CloudFront or similar
   - Update storage URLs in environment

---

## ✅ Verification Checklist

Quick checks before going live:

- [ ] Server running without errors
- [ ] Admin login working
- [ ] Products displaying on frontend
- [ ] Cart functionality working
- [ ] Checkout process complete
- [ ] Orders visible in admin
- [ ] Contact form functional
- [ ] Responsive on mobile
- [ ] No console errors (F12)
- [ ] Database backed up

---

## 📅 Version Info

**PRINTINGG NOVA v1.0.0**
- Built with Laravel 11
- Last Updated: January 27, 2026
- Status: Ready for Production ✅

---

**Happy Selling!** 🎉

For detailed information, refer to other documentation files in the project root.
