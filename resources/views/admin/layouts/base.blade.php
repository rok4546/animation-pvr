<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - E-Commerce</title>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .navbar {
            background: #000;
            color: white;
            padding: 15px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            border-bottom: 3px solid #ff0000;
        }
        
        .navbar-content {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar h1 {
            color: #ff0000;
            font-size: 24px;
        }
        
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            padding: 8px 12px;
        }
        
        .navbar a:hover {
            background: #ff0000;
            border-radius: 3px;
        }
        
        .sidebar {
            background: #000;
            color: white;
            width: 250px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 60px;
            padding: 30px 0;
            border-right: 3px solid #ff0000;
            z-index: 99;
        }
        
        .sidebar-logo {
            padding: 0 20px;
            margin-bottom: 40px;
            text-align: center;
            border-bottom: 2px solid #ff0000;
            padding-bottom: 20px;
        }
        
        .sidebar-logo h2 {
            color: #ff0000;
            margin: 0;
            font-size: 20px;
        }
        
        .sidebar-logo p {
            color: #888;
            margin: 5px 0 0 0;
            font-size: 12px;
        }
        
        .sidebar ul {
            list-style: none;
        }
        
        .sidebar li {
            margin: 0;
        }
        
        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar a:hover {
            background: #111;
            border-left: 3px solid #ff0000;
            color: #ff0000;
        }
        
        .sidebar a.active {
            background: #111;
            border-left: 3px solid #ff0000;
            color: #ff0000;
        }
        
        .sidebar-submenu {
            display: none;
            background: #0a0a0a;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .sidebar-submenu.active {
            display: block;
            max-height: 500px;
        }
        
        .sidebar-submenu a {
            padding: 12px 20px 12px 40px;
            font-size: 13px;
            border-left: 2px solid transparent;
        }
        
        .sidebar-submenu a:hover {
            background: #1a1a1a;
            border-left: 2px solid #ff0000;
        }
        
        .sidebar-submenu a.active {
            background: #1a1a1a;
            border-left: 2px solid #ff0000;
            color: #ff0000;
        }
        
        .sidebar-menu-toggle {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }
        
        .sidebar-menu-toggle::after {
            content: '▼';
            font-size: 10px;
            transition: transform 0.3s;
            margin-left: 10px;
        }
        
        .sidebar-menu-toggle.active::after {
            transform: rotate(-180deg);
        }
        
        .sidebar-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: #111;
            border-top: 1px solid #333;
        }
        
        .sidebar-bottom p {
            color: #888;
            font-size: 11px;
            margin: 0;
        }
        
        .sidebar-bottom .user-name {
            color: #fff;
            margin: 5px 0 0 0;
            font-weight: bold;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 80px 20px 20px 20px;
            min-height: 100vh;
        }
        
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #ff0000;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }
        
        .btn:hover {
            background: #cc0000;
        }
        
        .btn-secondary {
            background: #666;
        }
        
        .btn-secondary:hover {
            background: #555;
        }
        
        .btn-danger {
            background: #d32f2f;
        }
        
        .btn-danger:hover {
            background: #b71c1c;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th {
            background: #000;
            color: white;
            padding: 12px;
            text-align: left;
        }
        
        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        
        table tr:hover {
            background: #f9f9f9;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
        }
        
        textarea {
            resize: vertical;
            min-height: 150px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #ff0000;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                top: 0;
                min-height: auto;
                margin-bottom: 20px;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar a {
                display: inline-block;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-content">
            <h1>ADMIN PANEL</h1>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <h2 style="display: flex; align-items: center; gap: 8px; margin: 0; font-size: 20px;">
                <span style="font-size: 24px;">✨</span>
                ANIME
            </h2>
            <p style="color: #f44336; margin: 5px 0 0 0; font-size: 12px; font-weight: 600;">ARTISTRY</p>
        </div>

        <ul>
            <!-- Dashboard -->
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">📊 Dashboard</a></li>
            
            <!-- Catalog Dropdown -->
            <li>
                <a href="javascript:void(0)" class="sidebar-menu-toggle {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.anime-collections.*') ? 'active' : '' }}" onclick="toggleMenu(this)">
                    <span>📦 Catalog</span>
                </a>
                <div class="sidebar-submenu {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.anime-collections.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">📦 Products</a>
                    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">📂 Categories</a>
                    <a href="{{ route('admin.anime-collections.index') }}" class="{{ request()->routeIs('admin.anime-collections.*') ? 'active' : '' }}">🎌 Anime Collections</a>
                </div>
            </li>
            
            <!-- Orders Dropdown -->
            <li>
                <a href="javascript:void(0)" class="sidebar-menu-toggle {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" onclick="toggleMenu(this)">
                    <span>📋 Orders</span>
                </a>
                <div class="sidebar-submenu {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.index') && !request('status') ? 'active' : '' }}">📋 All Orders</a>
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="{{ request('status') === 'pending' ? 'active' : '' }}">⏳ Pending</a>
                    <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="{{ request('status') === 'processing' ? 'active' : '' }}">⚙️ Processing</a>
                    <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="{{ request('status') === 'shipped' ? 'active' : '' }}">🚚 Shipped</a>
                    <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="{{ request('status') === 'delivered' ? 'active' : '' }}">✅ Delivered</a>
                    <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="{{ request('status') === 'cancelled' ? 'active' : '' }}">❌ Cancelled</a>
                </div>
            </li>
            
            <!-- Marketing Dropdown -->
            <li>
                <a href="javascript:void(0)" class="sidebar-menu-toggle {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.coupons.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.newsletter.*') ? 'active' : '' }}" onclick="toggleMenu(this)">
                    <span>📢 Marketing</span>
                </a>
                <div class="sidebar-submenu {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.coupons.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.newsletter.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.banners.index') }}" class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">🎨 Banners</a>
                    <a href="{{ route('admin.coupons.index') }}" class="{{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">🎫 Coupons</a>
                    <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">⭐ Testimonials</a>
                    <a href="{{ route('admin.newsletter.index') }}" class="{{ request()->routeIs('admin.newsletter.*') ? 'active' : '' }}">📧 Newsletter</a>
                </div>
            </li>
            
            <!-- Reports Dropdown -->
            <li>
                <a href="javascript:void(0)" class="sidebar-menu-toggle {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" onclick="toggleMenu(this)">
                    <span>📈 Reports</span>
                </a>
                <div class="sidebar-submenu {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports.sales') }}" class="{{ request()->routeIs('admin.reports.sales') ? 'active' : '' }}">💰 Sales Report</a>
                    <a href="{{ route('admin.reports.products') }}" class="{{ request()->routeIs('admin.reports.products') ? 'active' : '' }}">📦 Product Report</a>
                    <a href="{{ route('admin.reports.customers') }}" class="{{ request()->routeIs('admin.reports.customers') ? 'active' : '' }}">👥 Customer Report</a>
                    <a href="{{ route('admin.reports.inventory') }}" class="{{ request()->routeIs('admin.reports.inventory') ? 'active' : '' }}">📊 Inventory Report</a>
                </div>
            </li>
            
            <!-- Pages -->
            <li><a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">📄 Pages</a></li>
            
            <!-- Settings Dropdown -->
            <li>
                <a href="javascript:void(0)" class="sidebar-menu-toggle {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" onclick="toggleMenu(this)">
                    <span>⚙️ Settings</span>
                </a>
                <div class="sidebar-submenu {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.general') }}" class="{{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">🔧 General</a>
                    <a href="{{ route('admin.settings.shipping') }}" class="{{ request()->routeIs('admin.settings.shipping') ? 'active' : '' }}">🚚 Shipping</a>
                    <a href="{{ route('admin.settings.payment') }}" class="{{ request()->routeIs('admin.settings.payment') ? 'active' : '' }}">💳 Payment</a>
                    <a href="{{ route('admin.settings.seo') }}" class="{{ request()->routeIs('admin.settings.seo') ? 'active' : '' }}">🔍 SEO</a>
                </div>
            </li>
        </ul>

        <div style="margin: 30px 20px; border-top: 1px solid #333;"></div>

        <div style="padding: 0 20px;">
            <a href="{{ url('/') }}" target="_blank" style="
                display: block;
                padding: 10px 15px;
                color: #fff;
                text-decoration: none;
                background: #222;
                border-radius: 4px;
                margin-bottom: 10px;
                transition: all 0.3s;
            ">
                👁️ View Site
            </a>

            <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="
                    width: 100%;
                    padding: 10px 15px;
                    color: #fff;
                    background: #222;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    transition: all 0.3s;
                ">
                    🚪 Logout
                </button>
            </form>
        </div>

        <div class="sidebar-bottom">
            <p>Logged in as:</p>
            <p class="user-name">{{ auth()->user()->name }}</p>
        </div>
    </div>

    <div class="main-content">
        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        function toggleMenu(element) {
            const submenu = element.nextElementSibling;
            const isActive = submenu.classList.contains('active');
            
            // Close other menus
            document.querySelectorAll('.sidebar-submenu').forEach(menu => {
                if (menu !== submenu) {
                    menu.classList.remove('active');
                }
            });
            
            document.querySelectorAll('.sidebar-menu-toggle').forEach(toggle => {
                if (toggle !== element) {
                    toggle.classList.remove('active');
                }
            });
            
            // Toggle current menu
            if (isActive) {
                submenu.classList.remove('active');
                element.classList.remove('active');
            } else {
                submenu.classList.add('active');
                element.classList.add('active');
            }
        }
        
        // Keep submenu open if we're on a page within that section
        window.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.sidebar-submenu.active').forEach(submenu => {
                const toggle = submenu.previousElementSibling;
                if (toggle && toggle.classList.contains('sidebar-menu-toggle')) {
                    toggle.classList.add('active');
                }
            });
        });
        
        // Initialize DataTables on all tables with class 'datatable'
        $(document).ready(function() {
            if ($.fn.DataTable) {
                $('.datatable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    pageLength: 25,
                    order: [[0, 'desc']],
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries available",
                        infoFiltered: "(filtered from _MAX_ total entries)",
                        zeroRecords: "No matching records found"
                    }
                });
            }
        });
    </script>
</body>
</html>
