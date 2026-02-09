<!-- Admin Sidebar -->
<div style="
    width: 250px;
    background: #000;
    color: #fff;
    min-height: 100vh;
    padding: 30px 0;
    position: fixed;
    left: 0;
    top: 0;
    border-right: 3px solid #ff0000;
">
    <!-- Logo -->
    <div style="padding: 0 20px; margin-bottom: 40px; text-align: center; border-bottom: 2px solid #ff0000; padding-bottom: 20px;">
        <h2 style="color: #ff0000; margin: 0; font-size: 20px;">ADMIN</h2>
        <p style="color: #888; margin: 5px 0 0 0; font-size: 12px;">ANIME ARTISTRY</p>
    </div>

    <!-- Navigation Links -->
    <nav>
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" style="
            display: block;
            padding: 15px 20px;
            color: {{ request()->routeIs('admin.dashboard') ? '#ff0000' : '#fff' }};
            text-decoration: none;
            border-left: 3px solid {{ request()->routeIs('admin.dashboard') ? '#ff0000' : 'transparent' }};
            background: {{ request()->routeIs('admin.dashboard') ? '#111' : 'transparent' }};
            transition: all 0.3s;
        " onmouseover="this.style.background='#111'" onmouseout="this.style.background='{{ request()->routeIs('admin.dashboard') ? '#111' : 'transparent' }}'">
            📊 Dashboard
        </a>

        <!-- Products -->
        <a href="{{ route('admin.products.index') }}" style="
            display: block;
            padding: 15px 20px;
            color: {{ request()->routeIs('admin.products.*') ? '#ff0000' : '#fff' }};
            text-decoration: none;
            border-left: 3px solid {{ request()->routeIs('admin.products.*') ? '#ff0000' : 'transparent' }};
            background: {{ request()->routeIs('admin.products.*') ? '#111' : 'transparent' }};
            transition: all 0.3s;
        " onmouseover="this.style.background='#111'" onmouseout="this.style.background='{{ request()->routeIs('admin.products.*') ? '#111' : 'transparent' }}'">
            📦 Products
        </a>

        <!-- Categories -->
        <a href="{{ route('admin.categories.index') }}" style="
            display: block;
            padding: 15px 20px;
            color: {{ request()->routeIs('admin.categories.*') ? '#ff0000' : '#fff' }};
            text-decoration: none;
            border-left: 3px solid {{ request()->routeIs('admin.categories.*') ? '#ff0000' : 'transparent' }};
            background: {{ request()->routeIs('admin.categories.*') ? '#111' : 'transparent' }};
            transition: all 0.3s;
        " onmouseover="this.style.background='#111'" onmouseout="this.style.background='{{ request()->routeIs('admin.categories.*') ? '#111' : 'transparent' }}'">
            📂 Categories
        </a>

        <!-- Orders -->
        <a href="{{ route('admin.orders.index') }}" style="
            display: block;
            padding: 15px 20px;
            color: {{ request()->routeIs('admin.orders.*') ? '#ff0000' : '#fff' }};
            text-decoration: none;
            border-left: 3px solid {{ request()->routeIs('admin.orders.*') ? '#ff0000' : 'transparent' }};
            background: {{ request()->routeIs('admin.orders.*') ? '#111' : 'transparent' }};
            transition: all 0.3s;
        " onmouseover="this.style.background='#111'" onmouseout="this.style.background='{{ request()->routeIs('admin.orders.*') ? '#111' : 'transparent' }}'">
            📋 Orders
        </a>

        <!-- Pages -->
        <a href="{{ route('admin.pages.index') }}" style="
            display: block;
            padding: 15px 20px;
            color: {{ request()->routeIs('admin.pages.*') ? '#ff0000' : '#fff' }};
            text-decoration: none;
            border-left: 3px solid {{ request()->routeIs('admin.pages.*') ? '#ff0000' : 'transparent' }};
            background: {{ request()->routeIs('admin.pages.*') ? '#111' : 'transparent' }};
            transition: all 0.3s;
        " onmouseover="this.style.background='#111'" onmouseout="this.style.background='{{ request()->routeIs('admin.pages.*') ? '#111' : 'transparent' }}'">
            📄 Pages
        </a>
    </nav>

    <!-- Divider -->
    <div style="margin: 30px 20px; border-top: 1px solid #333;"></div>

    <!-- Quick Actions -->
    <div style="padding: 0 20px;">
        <p style="color: #888; font-size: 12px; margin: 0 0 10px 0; text-transform: uppercase;">Quick Links</p>
        
        <a href="{{ url('/') }}" target="_blank" style="
            display: block;
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
            background: #222;
            border-radius: 4px;
            margin-bottom: 10px;
            transition: all 0.3s;
        " onmouseover="this.style.background='#ff0000'" onmouseout="this.style.background='#222'">
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
            " onmouseover="this.style.background='#ff0000'" onmouseout="this.style.background='#222'">
                🚪 Logout
            </button>
        </form>
    </div>

    <!-- User Info -->
    <div style="
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: #111;
        border-top: 1px solid #333;
    ">
        <p style="color: #888; font-size: 11px; margin: 0;">Logged in as:</p>
        <p style="color: #fff; margin: 5px 0 0 0; font-weight: bold;">{{ auth()->user()->name }}</p>
    </div>
</div>

<!-- Main Content Area (margin for sidebar) -->
<div style="margin-left: 250px;">
