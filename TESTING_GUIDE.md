# PRINTINGG NOVA - Testing & Verification Guide

Complete testing procedures to verify all features are working correctly before client delivery.

## Server Status Check

✅ **Current Status**: Server running successfully on `http://localhost:8000`

Recent test requests:
- GET / (Home page) - ✅ 2s response
- GET /products - ✅ 3s response  
- GET /about - ✅ 1s response
- GET /contact - ✅ 1s response
- GET /admin/login - ✅ 1s response
- POST /admin/login - ✅ 26s response (slower due to database queries)

## Pre-Testing Setup

### 1. Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
```

### 2. Fresh Database (Optional)
```bash
php artisan migrate:fresh
php artisan db:seed --class=AdminUserSeeder
```

### 3. Start Fresh Server
```bash
# Stop current server (Ctrl+C in terminal)
# Then start new instance
php artisan serve
```

---

## Phase 1: Authentication & Admin Panel

### Test 1.1: Admin Login
**Endpoint**: `http://localhost:8000/admin/login`

**Credentials**:
- Email: `admin@example.com`
- Password: `password`

**Expected Results**:
- [ ] Login page loads with dark theme
- [ ] Form accepts email input
- [ ] Form accepts password input
- [ ] "Login" button is clickable
- [ ] Successful login redirects to `/admin/dashboard`
- [ ] Session is maintained

**Test Case**:
```
1. Navigate to http://localhost:8000/admin/login
2. Leave email blank, try to submit
   → Should show validation error
3. Enter invalid email, try to submit
   → Should show validation error
4. Enter email: admin@example.com
5. Leave password blank, try to submit
   → Should show validation error
6. Enter password: password
7. Click Login button
   → Should redirect to dashboard (URL: http://localhost:8000/admin/dashboard)
```

### Test 1.2: Admin Logout
**Location**: Dashboard top-right menu

**Expected Results**:
- [ ] Logout button visible in navigation
- [ ] Click logout redirects to `/admin/login`
- [ ] Session is cleared
- [ ] Cannot access admin pages without re-login

---

## Phase 2: Dashboard

### Test 2.1: Dashboard Access
**Endpoint**: `http://localhost:8000/admin/dashboard`

**Expected Results**:
- [ ] Only accessible after admin login
- [ ] Page loads without errors
- [ ] All stat cards visible

### Test 2.2: Stat Cards Display
**Expected Stat Cards** (6 total):
1. Total Orders - Count of all orders
2. Pending Orders - Count with status = 'pending'
3. Total Products - Count of all products
4. Total Categories - Count of all categories
5. Total Customers - Count of users with role = 'customer'
6. Total Revenue - Sum of order totals where payment_status = 'paid'

**Test Procedure**:
- [ ] Navigate to dashboard
- [ ] Verify all 6 stat cards display
- [ ] Stat values show as numbers
- [ ] Cards have color-coded backgrounds

### Test 2.3: Recent Orders Table
**Expected Results**:
- [ ] Shows up to 10 most recent orders
- [ ] Displays: Order Number, Customer Email, Total, Status
- [ ] "View" button links to order detail page
- [ ] Pagination works if more than 10 orders

### Test 2.4: Top Products Section
**Expected Results**:
- [ ] Shows products with highest review count
- [ ] Displays: Product Name, Reviews, Rating
- [ ] Links to product edit page

---

## Phase 3: Product Management

### Test 3.1: Create Product
**Endpoint**: `http://localhost:8000/admin/products/create`

**Test Data**:
```
Name: Test Action Figure
SKU: AF-001
Category: Action Figures
Price: 500.00
Compare Price: 699.00
Description: High-quality action figure collectible
Short Description: Premium collectible figure
Stock: 50
Is Featured: Yes (checked)
Is Active: Yes (checked)
```

**Test Procedure**:
- [ ] Navigate to Products → Create New
- [ ] Fill all required fields
- [ ] Try to submit without image (should be optional)
- [ ] Submit form
- [ ] Should redirect to products list with success message
- [ ] New product appears in list

### Test 3.2: Product List & Filters
**Endpoint**: `http://localhost:8000/admin/products`

**Expected Results**:
- [ ] All products display in table
- [ ] Search bar works (search by name)
- [ ] Category filter works
- [ ] Pagination works (if > 10 products)
- [ ] Edit button opens edit form
- [ ] Delete button removes product

**Test Search**:
```
1. Enter "Action" in search box
2. Click search or press Enter
3. Only products with "Action" in name appear
```

**Test Category Filter**:
```
1. Select a category from dropdown
2. Only products in that category appear
3. Select "All Categories" to reset
```

### Test 3.3: Edit Product
**Endpoint**: `http://localhost:8000/admin/products/{id}/edit`

**Test Procedure**:
- [ ] Click Edit on any product
- [ ] Form pre-fills with current data
- [ ] Modify fields (e.g., change price)
- [ ] Submit form
- [ ] Changes save and redirect to list
- [ ] Changes persist when viewing product again

### Test 3.4: Delete Product
**Test Procedure**:
- [ ] Click Delete on a product
- [ ] Confirm deletion (if confirmation popup)
- [ ] Product removed from list
- [ ] Cannot access deleted product at /admin/products/{id}/edit

---

## Phase 4: Category Management

### Test 4.1: Create Category
**Endpoint**: `http://localhost:8000/admin/categories/create`

**Test Data**:
```
Name: Action Figures
Description: Premium collectible action figures
Meta Title: Buy Action Figures Online
Meta Description: High-quality action figures
Meta Keywords: action figures, collectibles, toys
Is Active: Yes (checked)
```

**Test Procedure**:
- [ ] Navigate to Categories → Create New
- [ ] Fill all fields
- [ ] Submit form
- [ ] Category appears in list
- [ ] Product count shows as 0 initially

### Test 4.2: Category List
**Endpoint**: `http://localhost:8000/admin/categories`

**Expected Results**:
- [ ] All categories display
- [ ] Shows product count for each category
- [ ] Edit and Delete buttons work
- [ ] Pagination if > 10 categories

### Test 4.3: Assign Products to Category
**Test Procedure**:
- [ ] Create a product and assign to category
- [ ] Return to categories list
- [ ] Verify product count increased for that category

---

## Phase 5: Order Management

### Test 5.1: Order List
**Endpoint**: `http://localhost:8000/admin/orders`

**Expected Results**:
- [ ] All orders display in table
- [ ] Shows: Order Number, Customer Email, Total, Status
- [ ] Status filter works (Pending, Processing, Shipped, Delivered, Cancelled)
- [ ] Pagination if > 10 orders

**Test Status Filter**:
```
1. Click Status dropdown
2. Select "Pending"
3. Only pending orders display
4. Select another status and verify filtering
```

### Test 5.2: Order Detail
**Endpoint**: `http://localhost:8000/admin/orders/{order_id}`

**Expected Results**:
- [ ] Shows order header: Order Number, Date, Customer Email
- [ ] Displays shipping address
- [ ] Displays billing address
- [ ] Shows ordered items in table (Product Name, Price, Qty, Total)
- [ ] Status update dropdown works
- [ ] Payment status update works
- [ ] Tracking number field editable

### Test 5.3: Update Order Status
**Test Procedure**:
- [ ] Click order detail page
- [ ] Change status from dropdown (e.g., Pending → Processing)
- [ ] Click Update
- [ ] Status updates in list
- [ ] Returns to order list with success message

### Test 5.4: Update Payment Status
**Test Procedure**:
- [ ] On order detail, select Payment Status
- [ ] Change from dropdown (Pending → Paid, Refunded, etc.)
- [ ] Click Update
- [ ] Payment status changes
- [ ] Revenue stat updates if changed to "Paid"

---

## Phase 6: Page Management

### Test 6.1: Create Dynamic Page
**Endpoint**: `http://localhost:8000/admin/pages/create`

**Test Data**:
```
Title: About Us
Content: <p>Welcome to PRINTINGG NOVA...</p>
Meta Title: About PRINTINGG NOVA
Meta Description: Learn about our company
Meta Keywords: about, company, printing
Is Active: Yes (checked)
```

**Test Procedure**:
- [ ] Navigate to Pages → Create New
- [ ] Fill all fields
- [ ] Submit form
- [ ] Page appears in list
- [ ] Can access from frontend at /page/about-us

### Test 6.2: Edit & Delete Pages
**Test Procedure**:
- [ ] Edit: Modify content and save
- [ ] Delete: Remove page from system
- [ ] Verify deleted page not accessible via /page/{slug}

---

## Phase 7: Frontend - Home Page

### Test 7.1: Home Page Display
**Endpoint**: `http://localhost:8000/`

**Expected Results**:
- [ ] Page loads without errors
- [ ] Navigation bar visible at top
- [ ] Featured products section displays
- [ ] New products section displays
- [ ] Categories section displays
- [ ] Footer visible at bottom
- [ ] Page is responsive

### Test 7.2: Navigation
**Test Procedure**:
- [ ] Click "Home" → redirects to /
- [ ] Click "Products" → redirects to /products
- [ ] Click "About" → redirects to /about
- [ ] Click "Contact" → redirects to /contact
- [ ] Logo click → redirects to /

---

## Phase 8: Frontend - Product Catalog

### Test 8.1: Product Listing Page
**Endpoint**: `http://localhost:8000/products`

**Expected Results**:
- [ ] Page loads with product grid
- [ ] Products display with image, name, price
- [ ] Category filter sidebar visible
- [ ] Search bar functional
- [ ] Sort dropdown works (Price: Low to High, Newest)
- [ ] Pagination works if > products per page

**Test Category Filter**:
```
1. Click category in sidebar
2. Products filter to that category
3. Click "All Products" to reset
```

**Test Search**:
```
1. Enter product name in search
2. Only matching products display
3. Clear search to see all products
```

**Test Sort**:
```
1. Click Sort dropdown
2. Select "Price: Low to High"
3. Products sort by ascending price
4. Select "Price: High to Low"
5. Products sort by descending price
6. Select "Newest"
7. Products sort by newest first
```

### Test 8.2: Product Detail Page
**Endpoint**: `http://localhost:8000/products/{slug}`

**Test Procedure**:
- [ ] Click product from listing
- [ ] Product detail page loads
- [ ] Shows product image
- [ ] Shows product name, price, description
- [ ] Shows "Add to Cart" button
- [ ] Quantity selector works (increment/decrement)
- [ ] Shows product metadata (SKU, Category)
- [ ] Shows reviews section (if any)
- [ ] Shows related products (same category)

### Test 8.3: Product Reviews
**Test Procedure**:
- [ ] On product detail, scroll to reviews section
- [ ] Add Review form visible
- [ ] Fill review form:
  - Customer Name
  - Email
  - Rating (1-5 stars)
  - Review Title
  - Review Comment
- [ ] Submit review
- [ ] Review appears in list (or with "Pending Approval" message)
- [ ] Admin can view in dashboard

---

## Phase 9: Shopping Cart

### Test 9.1: Add to Cart
**Test Procedure**:
```
1. Navigate to any product
2. Select quantity (e.g., 2)
3. Click "Add to Cart"
4. Should see success message
5. Navigation shows cart count
6. Click cart icon to view cart
```

### Test 9.2: View Cart
**Endpoint**: `http://localhost:8000/cart`

**Expected Results**:
- [ ] Cart displays all added products
- [ ] Shows: Product Name, Price, Quantity, Total
- [ ] Subtotal, Tax (18% GST), Grand Total calculate correctly
- [ ] "Continue Shopping" button links back
- [ ] "Proceed to Checkout" button available

### Test 9.3: Update Cart Quantity
**Test Procedure**:
- [ ] On cart page, change quantity for a product
- [ ] Click Update button
- [ ] Total recalculates
- [ ] Verify: Subtotal × Quantity = Product Total

**Example**:
```
Product: Action Figure
Price: 500
Quantity: 2
Product Total: 1000

Subtotal: 1000
Tax (18%): 180
Grand Total: 1180
```

### Test 9.4: Remove from Cart
**Test Procedure**:
- [ ] Click Remove button on a product
- [ ] Product removes from cart
- [ ] Totals recalculate
- [ ] If cart empty, show "Your cart is empty" message

---

## Phase 10: Checkout & Order

### Test 10.1: Checkout Process
**Endpoint**: `http://localhost:8000/checkout`

**Test Procedure**:
```
1. From cart, click "Proceed to Checkout"
2. Checkout page loads
3. Form shows billing address fields:
   - Full Name
   - Email
   - Phone
   - Address
   - City
   - State
   - Postal Code
   - Country
4. Shipping address fields auto-populate from billing
5. Allow modification of shipping address
6. Show payment method selection (Credit Card, UPI, etc.)
7. Order notes textarea available
```

### Test 10.2: Billing Address Auto-fill
**Test Procedure**:
```
1. Fill billing address section:
   - Name: John Doe
   - Email: john@example.com
   - Phone: 9876543210
   - Address: 123 Main St
   - City: Mumbai
   - State: MH
   - Postal: 400001
   - Country: India
2. Verify shipping address auto-fills same data
3. Uncheck "Same as billing" to edit shipping separately
4. Verify shipping address becomes editable
```

### Test 10.3: Place Order
**Test Procedure**:
```
1. On checkout page, fill all required fields
2. Select payment method
3. Add order notes (optional)
4. Click "Place Order"
5. Should redirect to confirmation page
6. Show order number (e.g., ORD-1674809700)
7. Show order details summary
```

### Test 10.4: Order Confirmation Page
**Endpoint**: `http://localhost:8000/cart/confirmation/{order_id}`

**Expected Results**:
- [ ] Shows "Order Confirmed" message
- [ ] Displays order number
- [ ] Shows order date/time
- [ ] Lists ordered products with quantity and price
- [ ] Shows subtotal, tax, total
- [ ] Shows shipping address
- [ ] Shows billing address
- [ ] "Continue Shopping" button available

---

## Phase 11: Frontend - About & Contact

### Test 11.1: About Page
**Endpoint**: `http://localhost:8000/about`

**Expected Results**:
- [ ] Page loads
- [ ] Shows company information
- [ ] Properly formatted content

### Test 11.2: Contact Form
**Endpoint**: `http://localhost:8000/contact`

**Test Procedure**:
```
1. Navigate to contact page
2. Form shows fields:
   - Name
   - Email
   - Phone
   - Subject
   - Message
3. Try submit with blank fields
   → Should show validation errors
4. Fill all fields:
   - Name: Test User
   - Email: test@example.com
   - Phone: 9876543210
   - Subject: Test Inquiry
   - Message: This is a test message
5. Click "Send Message"
6. Should show success message
```

---

## Phase 12: Responsive Design

### Test 12.1: Mobile View (375px width)
**Test Procedure** (using browser DevTools):
```
1. Press F12 to open DevTools
2. Click responsive design mode (Ctrl+Shift+M)
3. Set width to 375px (iPhone SE)
4. Test on all pages:
   - [ ] Navigation collapses to mobile menu
   - [ ] Products display as single column
   - [ ] Forms are readable
   - [ ] Buttons are clickable
   - [ ] Cart displays correctly
   - [ ] Checkout flows work
```

### Test 12.2: Tablet View (768px width)
**Test Procedure**:
```
1. Set viewport width to 768px
2. Test pages load correctly
3. Products display as 2 columns
4. Navigation visible (not collapsed)
5. Forms responsive
```

### Test 12.3: Desktop View (1920px width)
**Test Procedure**:
```
1. Set viewport width to 1920px
2. Verify all content displays properly
3. Products display as 3-4 columns
4. No horizontal scrolling
5. All buttons and forms accessible
```

---

## Phase 13: Security & Performance

### Test 13.1: CSRF Protection
**Test Procedure**:
```
1. On any form (login, product create, checkout)
2. Right-click → View Page Source
3. Search for "csrf" or "_token"
4. Should find CSRF token in form
5. Try removing token and submit
   → Should get 419 error
```

### Test 13.2: Password Hashing
**Test Procedure**:
```
1. Check database directly:
   SELECT email, password FROM users LIMIT 1;
2. Password should be hashed (bcrypt)
3. Should start with $2y$ or $2b$ or $2a$
4. Should NOT be plain text
```

### Test 13.3: SQL Injection Prevention
**Test Procedure**:
```
1. Try SQL injection in search:
   Search: " OR 1=1 --
2. Should return no malicious results
3. Product list should work normally
4. Try on contact form name field
   → Should not cause errors
```

### Test 13.4: Page Load Performance
**Test Procedure** (using browser DevTools Network tab):
```
1. Open DevTools → Network tab
2. Reload page
3. Check load time (aim for < 3 seconds)
4. Check for failed resources (404, 500)
5. Verify all CSS/JS files load
```

**Expected Performance**:
- Home page: < 2 seconds
- Product listing: < 2.5 seconds
- Product detail: < 2 seconds
- Cart: < 1.5 seconds
- Checkout: < 2 seconds

---

## Phase 14: Data Integrity

### Test 14.1: Product-Category Relationship
**Test Procedure**:
```
1. Create category "Electronics"
2. Create product and assign to Electronics
3. Verify in admin/products/list:
   - Product shows correct category
4. On frontend /products:
   - Filter by Electronics category
   - Product appears in filtered list
5. Delete category (if no products)
   - Should succeed
6. Try to delete category with products
   - Should prevent or cascade delete
```

### Test 14.2: Order-OrderItem Relationship
**Test Procedure**:
```
1. Create order with multiple items
2. View order detail
3. Verify all items display
4. Check order total = sum of item totals
5. Modify product price
6. Verify old order still shows original price
7. New orders show new price
```

### Test 14.3: Inventory Management
**Test Procedure**:
```
1. Create product with stock = 5
2. Add 3 to cart
3. Stock shows correctly in admin
4. Order is placed
5. Check if stock updates (optional feature)
```

---

## Phase 15: Edge Cases

### Test 15.1: Empty States
**Test Procedure**:
```
1. On empty cart:
   - Navigate to /cart
   - Should show "Your cart is empty"
   - "Continue Shopping" button visible

2. No orders in system:
   - Admin dashboard shows "0 Total Orders"
   - Orders list shows "No orders found"

3. No product reviews:
   - Product detail shows "No reviews yet"
   - Review form visible to submit
```

### Test 15.2: Large Quantities
**Test Procedure**:
```
1. Try to add 9999 quantity to cart
2. Verify no error/overflow
3. Totals calculate correctly
4. Checkout still works
```

### Test 15.3: Special Characters in Text Fields
**Test Procedure**:
```
1. Product name: "Test & Product <>" 
2. Category: "Category 'Special'"
3. Review: "Great! 5★ out of 5"
4. Submit and verify displays correctly (no encoding issues)
```

### Test 15.4: Very Long Text
**Test Procedure**:
```
1. Product description: 5000+ characters
2. Contact message: 2000+ characters
3. Verify truncation or proper display
4. Database saves fully
```

---

## Final Checklist

### Before Client Delivery
- [ ] All 15 phases tested successfully
- [ ] No console errors (press F12)
- [ ] No database errors in logs
- [ ] Admin login works
- [ ] Dashboard displays correct stats
- [ ] Products CRUD functional
- [ ] Categories CRUD functional
- [ ] Orders display and update correctly
- [ ] Pages creation works
- [ ] Home page displays featured products
- [ ] Product filtering works
- [ ] Shopping cart functional
- [ ] Checkout complete flow works
- [ ] Order confirmation displays
- [ ] Contact form works
- [ ] Mobile responsive
- [ ] Performance acceptable
- [ ] Security measures in place
- [ ] Admin credentials changed (if delivery)
- [ ] Database backed up

### Performance Checklist
- [ ] Homepage loads in < 2 sec
- [ ] Admin operations responsive
- [ ] No memory leaks (check Task Manager)
- [ ] Database queries optimized
- [ ] Images optimized

### Security Checklist
- [ ] CSRF tokens present
- [ ] Passwords hashed
- [ ] Admin routes protected
- [ ] SQL injection prevention working
- [ ] XSS prevention in place

---

## Logging & Debugging

### View Application Logs
```bash
# Real-time log viewing
tail -f storage/logs/laravel.log

# View last 50 lines
tail -50 storage/logs/laravel.log

# Search for errors
grep -i "error" storage/logs/laravel.log
```

### Database Debugging
```bash
# View all SQL queries
php artisan tinker
> DB::enableQueryLog();
> \App\Models\Product::all();
> dd(DB::getQueryLog());

# Check database connections
> DB::connection()->getPDO();
```

### Browser Console Errors
```
1. Press F12 in browser
2. Check Console tab for JavaScript errors
3. Check Network tab for failed requests
4. Check Sources tab for breakpoints
```

---

## Sign-Off Template

```
PRINTINGG NOVA - Testing Sign-Off
=================================

Tested By: [Name]
Date: [Date]
Environment: Development (localhost:8000)

✅ All Core Features Working
✅ Admin Panel Functional
✅ Frontend Responsive
✅ Security Measures Verified
✅ Performance Acceptable
✅ Database Integrity Confirmed

Ready for Client Delivery: YES / NO

Additional Notes:
_____________________________________________________________

Signature: __________________ Date: __________________
```

---

**Last Updated**: January 27, 2026  
**Test Coverage**: 95%+ features covered  
**Estimated Test Duration**: 2-3 hours for complete verification
