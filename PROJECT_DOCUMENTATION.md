# PRINTINGG NOVA - E-Commerce Website

A complete, professional-grade e-commerce platform built with Laravel 11, featuring an admin dashboard for managing products, categories, orders, and pages.

## Features

### Admin Panel
- **Admin Login**: Secure admin authentication with email and password
- **Dashboard**: Real-time statistics including total orders, products, categories, customers, and revenue
- **Product Management**: 
  - Add, edit, and delete products
  - Upload product images
  - Set pricing and compare prices
  - Manage stock levels
  - Add SEO metadata (title, description, keywords)
  - Featured product flag
- **Category Management**:
  - Create and manage product categories
  - Upload category images
  - Organize products by category
- **Order Management**:
  - View all orders with advanced filtering
  - Update order status (pending, processing, shipped, delivered, cancelled)
  - Update payment status
  - Track shipments with tracking numbers
  - View order items and customer details
- **Page Management**:
  - Create dynamic pages (About, Contact, etc.)
  - SEO optimization for pages
  - Easy content management

### Frontend
- **Home Page**: Featured products, new arrivals, and category browsing
- **Product Catalog**: 
  - Browse all products
  - Filter by category
  - Search functionality
  - Sort by price and newest
  - Product detail page with images and descriptions
- **Shopping Cart**: 
  - Add/remove products
  - Update quantities
  - View cart total
- **Checkout Process**:
  - Collect shipping and billing information
  - Order review before confirmation
  - Multiple payment methods support
- **Product Reviews**: Customers can leave and view product reviews
- **About & Contact Pages**: Dynamic content management
- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices

## Tech Stack

- **Backend**: Laravel 11
- **Database**: MySQL
- **Frontend**: Blade Templates with custom CSS
- **Authentication**: Laravel Authentication
- **File Storage**: Local storage with image optimization

## Installation & Setup

### Prerequisites
- PHP 8.1+
- MySQL 8.0+
- Composer

### Installation Steps

1. **Clone the repository**
```bash
cd c:\Users\satyam\Animationp_pvr
```

2. **Install dependencies**
```bash
composer install
```

3. **Create environment file**
```bash
copy .env.example .env
```

4. **Generate application key**
```bash
php artisan key:generate
```

5. **Configure database** (in `.env` file)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=animation
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run migrations**
```bash
php artisan migrate:fresh
```

7. **Seed database with admin user**
```bash
php artisan db:seed --class=AdminUserSeeder
```

8. **Start development server**
```bash
php artisan serve
```

9. **Access the application**
- Frontend: `http://localhost:8000`
- Admin Panel: `http://localhost:8000/admin/login`

## Default Admin Credentials

```
Email: admin@example.com
Password: password
```

## Directory Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/              # Admin controllers
│   │   ├── HomeController.php
│   │   ├── ProductController.php
│   │   └── CartController.php
│   ├── Models/                 # Eloquent models
│   └── Middleware/
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/               # Database seeders
├── resources/
│   ├── css/                   # Stylesheets
│   └── views/
│       ├── admin/             # Admin views
│       ├── products/          # Product views
│       ├── cart/              # Cart views
│       └── layouts/           # Layout templates
├── routes/
│   └── web.php               # Application routes
└── public/
    └── storage/              # Uploaded files
```

## Database Schema

### Users Table
- id, name, email, password, role, phone, address

### Categories Table
- id, name, slug, description, image, meta_title, meta_description, meta_keywords, is_active

### Products Table
- id, name, slug, description, short_description, price, compare_price
- stock, sku, category_id, image, images (JSON), rating, review_count
- meta_title, meta_description, meta_keywords, is_featured, is_active

### Orders Table
- id, user_id, order_number, guest_email, subtotal, tax, shipping, discount
- total, status, payment_status, payment_method, shipping_address, billing_address
- customer_notes, tracking_number, timestamps

### OrderItems Table
- id, order_id, product_id, product_name, product_sku, price, quantity, total

### Reviews Table
- id, product_id, user_id, customer_name, customer_email, rating, title, comment, is_approved

### Pages Table
- id, title, slug, content, meta_title, meta_description, meta_keywords, is_active

## Features in Detail

### Admin Features
1. **Dashboard Statistics**
   - Total orders count
   - Pending orders count
   - Total products count
   - Total categories count
   - Total customers count
   - Total revenue from paid orders

2. **Product Management**
   - Full CRUD operations
   - Image upload with local storage
   - SEO optimization fields
   - Featured product marking
   - Stock management
   - Price and compare price support

3. **Order Tracking**
   - Order status management
   - Payment status tracking
   - Shipping address management
   - Tracking number assignment
   - Customer notes storage

4. **Category Organization**
   - Hierarchical organization
   - Product count per category
   - Category images
   - SEO optimization

### Customer Features
1. **Product Discovery**
   - Browse by category
   - Search functionality
   - Filter and sort options
   - Detailed product pages

2. **Shopping Experience**
   - Add to cart with quantity selection
   - Real-time cart updates
   - Wishlist functionality
   - Product reviews and ratings

3. **Checkout Process**
   - Secure order placement
   - Multiple payment methods
   - Order confirmation
   - Email notifications

## File Uploads

Product and category images are stored in `storage/app/public/` and can be accessed via `storage/` route.

### Image Directories
- `storage/app/public/products/` - Product images
- `storage/app/public/categories/` - Category images

## Security Features

- CSRF protection on all forms
- SQL injection prevention through Eloquent ORM
- Password hashing with bcrypt
- Admin authentication middleware
- Role-based access control (admin/customer)

## Customization Guide

### Styling
Main styling is in the layout template:
[resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php)

### Add New Admin Feature
1. Create controller in `app/Http/Controllers/Admin/`
2. Create views in `resources/views/admin/`
3. Add routes in `routes/web.php` under admin prefix
4. Add migration if new database table needed

### Add New Frontend Page
1. Create method in appropriate controller
2. Create view blade file
3. Add route in web.php
4. Update navigation if needed

## API Endpoints Overview

### Public Routes
- `GET /` - Home page
- `GET /products` - Product listing
- `GET /products/{slug}` - Product details
- `GET /about` - About page
- `GET /contact` - Contact page
- `POST /contact` - Submit contact form
- `GET /cart` - View cart
- `POST /cart/add/{product}` - Add to cart
- `POST /cart/update/{product_id}` - Update cart quantity
- `POST /cart/remove/{product_id}` - Remove from cart
- `GET /checkout` - Checkout page
- `POST /checkout` - Process order

### Admin Routes (Protected)
- `GET /admin/login` - Admin login page
- `POST /admin/login` - Process admin login
- `POST /admin/logout` - Admin logout
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/products` - Products list
- `GET /admin/products/create` - Create product
- `POST /admin/products` - Store product
- `GET /admin/products/{product}/edit` - Edit product
- `PUT /admin/products/{product}` - Update product
- `DELETE /admin/products/{product}` - Delete product
- Similar routes for categories, orders, and pages

## Performance Optimization

- Database indexing on frequently queried columns
- Pagination on product and order lists
- Image optimization and local storage
- CSS and JavaScript optimization in templates

## Future Enhancements

- Payment gateway integration (Razorpay, PayPal)
- Email notifications
- Customer account dashboard
- Inventory management with low stock alerts
- Advanced analytics and reporting
- Product variations (sizes, colors)
- Coupon and discount management
- Newsletter subscription
- Social media integration
- Mobile app API

## Support & Maintenance

For issues, feature requests, or improvements, please contact:
- Email: info@printingnova.com
- Phone: +91 97809 93395

## License

This project is proprietary and confidential. All rights reserved.

---

**Version**: 1.0.0  
**Last Updated**: January 27, 2026  
**Built with**: Laravel 11, MySQL, Blade Templates

---

## Quick Start Commands

```bash
# Start development server
php artisan serve

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Create new admin user
php artisan tinker
> \App\Models\User::create(['name' => 'New Admin', 'email' => 'admin2@example.com', 'password' => bcrypt('password'), 'role' => 'admin'])

# Clear cache
php artisan cache:clear

# Generate sitemap (if needed)
php artisan sitemap:generate
```

---

**Happy Selling with PRINTINGG NOVA!** 🎉
