<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ANIME ARTISTRY') - Anime Merchandise Store</title>
    <meta name="description" content="@yield('meta_description', 'Shop anime action figures, weapons, light boxes, posters, mousepads, keychains and more')">
    <meta name="keywords" content="@yield('meta_keywords', 'anime, action figures, merchandise')">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
            }
            50% {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.6);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes rotateIn {
            from {
                opacity: 0;
                transform: rotate(-10deg);
            }
            to {
                opacity: 1;
                transform: rotate(0deg);
            }
        }

        @keyframes flip {
            0% {
                transform: rotateY(0deg);
            }
            100% {
                transform: rotateY(360deg);
            }
        }

        /* Custom Scrollbar with Animated Character */
        ::-webkit-scrollbar {
            width: 18px;
            background: linear-gradient(180deg, #000 0%, #0a0a0a 100%);
        }

        ::-webkit-scrollbar-track {
            background: #0a0a0a;
            border-radius: 10px;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.5);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            border: 2px solid #000;
            transition: all 0.3s ease;
            position: relative;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #764ba2 0%, #667eea 100%);
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.8), inset 0 0 5px rgba(255,255,255,0.2);
            border-color: #667eea;
        }

        ::-webkit-scrollbar-thumb:active {
            background: linear-gradient(180deg, #5568d3 0%, #643a8a 100%);
            box-shadow: 0 0 25px rgba(102, 126, 234, 1);
        }

        /* Firefox scrollbar */
        * {
            scrollbar-color: #667eea #0a0a0a;
            scrollbar-width: thin;
        }

        /* Scrollbar Character Animation using CSS pseudo-element */
        ::-webkit-scrollbar-thumb::after {
            content: '🎮';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 12px;
            animation: float 3s ease-in-out infinite;
        }

        /* Alternative using data attribute - Apply custom character via JavaScript */
        html {
            --scrollbar-character: '🚀';
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #efefef 100%);
            color: #333;
            animation: fadeIn 0.6s ease;
        }

        html {
            scroll-behavior: smooth;
        }
        
        .header {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            color: white;
            position: relative;
            z-index: 100;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            animation: slideInDown 0.6s ease;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            white-space: nowrap;
            animation: pulse 2s infinite;
        }
        
        .logo-text-main {
            color: white;
        }
        
        .logo-text-red {
            color: #ff0000;
        }
        
        .nav {
            display: flex;
            gap: 30px;
            list-style: none;
            flex-wrap: wrap;
            align-items: center;
        }

        .nav li {
            position: relative;
            animation: fadeIn 0.6s ease;
        }
        
        .nav a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .nav a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .nav a:hover::after,
        .nav a.active::after {
            width: 100%;
        }
        
        .nav a:hover {
            color: #ff0000;
            transform: translateY(-2px);
        }
        
        .nav a.active {
            color: #ff0000;
        }

        /* Dropdown Menu Styles */
        .dropdown-toggle::after {
            content: '▼';
            font-size: 9px;
            margin-left: 6px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .dropdown-toggle:hover::after {
            transform: rotate(180deg) scale(1.2);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: linear-gradient(135deg, #1a1a1a 0%, #222 100%);
            border: 1px solid #333;
            border-radius: 8px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            margin-top: 12px;
            z-index: 1000;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        .nav li:hover .dropdown-menu {
            max-height: 600px;
            animation: slideInDown 0.4s ease;
        }

        .dropdown-menu a {
            display: block;
            padding: 14px 20px;
            color: #ddd;
            text-decoration: none;
            font-size: 14px;
            border-bottom: 1px solid #2a2a2a;
            transition: all 0.3s ease;
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        .dropdown-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: translateX(-3px);
            transition: transform 0.3s ease;
        }

        .dropdown-menu a:hover::before {
            transform: translateX(0);
        }

        .dropdown-menu a:last-child {
            border-bottom: none;
        }

        .dropdown-menu a:hover {
            background: linear-gradient(90deg, rgba(102,126,234,0.1) 0%, rgba(118,75,162,0.1) 100%);
            color: #ff0000;
            padding-left: 25px;
            transform: translateX(5px);
        }
        
        .icon-link {
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            animation: fadeIn 0.8s ease;
        }

        .icon-link:hover {
            color: #ff0000;
            transform: scale(1.2) rotate(5deg);
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff0000;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .footer {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            color: white;
            padding: 80px 20px 30px;
            margin-top: 100px;
            animation: fadeIn 1s ease;
            box-shadow: 0 -10px 40px rgba(0,0,0,0.3);
            border-top: 1px solid #333;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, #764ba2, transparent);
            animation: slideInRight 1s ease;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
            margin-bottom: 40px;
        }
        
        .footer-section {
            animation: fadeIn 1s ease backwards;
        }

        .footer-section:nth-child(1) { animation-delay: 0.1s; }
        .footer-section:nth-child(2) { animation-delay: 0.2s; }
        .footer-section:nth-child(3) { animation-delay: 0.3s; }
        .footer-section:nth-child(4) { animation-delay: 0.4s; }
        
        .footer-section h3 {
            margin-bottom: 20px;
            color: #ff0000;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            animation: slideInLeft 0.6s ease;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section a {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-bottom: 12px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            padding-left: 0;
        }

        .footer-section a::before {
            content: '→';
            position: absolute;
            left: -20px;
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            color: #667eea;
        }

        .footer-section a:hover {
            color: #ff0000;
            padding-left: 20px;
            transform: translateX(5px);
        }

        .footer-section a:hover::before {
            left: 0;
            opacity: 1;
        }
        
        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 25px;
            text-align: center;
            color: #888;
            font-size: 13px;
            animation: fadeIn 1.2s ease;
        }

        .footer-bottom::before {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            margin: 0 auto 20px;
            border-radius: 2px;
            animation: slideInLeft 0.6s ease;
        }
        
        .alert {
            padding: 15px;
            margin: 20px 0;
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
        
        .btn {
            display: inline-block;
            padding: 12px 26px;
            background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(255, 0, 0, 0.3);
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }
        
        .btn:hover {
            background: linear-gradient(135deg, #ff2222 0%, #dd0000 100%);
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(255, 0, 0, 0.5);
        }

        .btn:active {
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid #ff0000;
            color: #ff0000;
        }
        
        .btn-outline:hover {
            background: #ff0000;
            color: white;
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin: 30px 0;
            animation: fadeIn 0.8s ease;
        }
        
        .category-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
            border: 1px solid rgba(102, 126, 234, 0.1);
            animation: fadeIn 0.6s ease backwards;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
            border-color: #667eea;
        }
        
        .category-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .category-card:hover img {
            transform: scale(1.1);
        }
        
        .category-card-name {
            padding: 18px;
            text-align: center;
            font-weight: 700;
            color: #1a1a1a;
            font-size: 14px;
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
            transition: all 0.3s ease;
        }

        .category-card:hover .category-card-name {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            animation: fadeIn 0.6s ease backwards;
            border: 1px solid rgba(102, 126, 234, 0.1);
            cursor: pointer;
        }
        
        .product-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 16px 40px rgba(102, 126, 234, 0.3);
            border-color: #667eea;
        }
        
        .product-image {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #f5f5f5 0%, #efefef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            position: relative;
            overflow: hidden;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .product-card:hover .product-image img {
            transform: scale(1.12) rotate(2deg);
        }
        
        .product-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            animation: bounce 1.5s infinite;
            box-shadow: 0 4px 12px rgba(255, 0, 0, 0.4);
        }
        
        .product-info {
            padding: 18px;
        }
        
        .product-name {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 10px;
            height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            color: #1a1a1a;
            transition: color 0.3s ease;
        }

        .product-card:hover .product-name {
            color: #667eea;
        }
        
        .product-price {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .product-price .original {
            color: #999;
            text-decoration: line-through;
            font-size: 13px;
            animation: fadeIn 0.5s ease;
        }
        
        .product-price .current {
            color: #ff0000;
            font-size: 18px;
            font-weight: 800;
            animation: slideInLeft 0.5s ease;
        }
        
        .product-actions {
            display: flex;
            gap: 10px;
        }
        
        .product-actions form {
            flex: 1;
        }
        
        .product-actions .btn {
            width: 100%;
            padding: 10px;
            font-size: 13px;
            margin: 0;
            animation: fadeIn 0.6s ease;
        }
        
        .section-title {
            font-size: 36px;
            font-weight: 800;
            text-align: center;
            margin: 50px 0 35px;
            color: #000;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fadeIn 0.8s ease;
            letter-spacing: 1px;
        }
        
        @media (max-width: 768px) {
            .nav {
                display: none;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
            
            .categories-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }

        /* Form Animations */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        textarea,
        select {
            background: white;
            border: 2px solid #e0e0e0;
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            width: 100%;
            font-family: inherit;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
            background: linear-gradient(135deg, rgba(102,126,234,0.02) 0%, rgba(118,75,162,0.02) 100%);
        }

        textarea:focus {
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.25);
        }

        .form-group {
            margin-bottom: 20px;
            animation: fadeIn 0.6s ease backwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        input:focus + label,
        textarea:focus + label {
            color: #667eea;
        }

        /* Table Animations */
        table {
            animation: fadeIn 0.8s ease;
            border-collapse: collapse;
            width: 100%;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, rgba(102,126,234,0.05) 0%, rgba(118,75,162,0.05) 100%);
            transform: scale(1.01);
        }

        tbody tr:hover td {
            color: #667eea;
        }

        /* Badge and Tag Animations */
        .badge {
            display: inline-block;
            padding: 6px 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            animation: slideInLeft 0.5s ease;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .badge-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .badge-danger {
            background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%);
        }

        /* Transition for page content */
        main {
            animation: fadeIn 0.6s ease;
        }

        .container {
            animation: fadeIn 0.8s ease;
        }

        /* Link Animations */
        a {
            transition: all 0.3s ease;
        }

        a:not(.btn):not(.dropdown-toggle):not(.dropdown-menu a):not(.footer-section a) {
            color: #667eea;
            text-decoration: none;
        }

        a:not(.btn):not(.dropdown-toggle):not(.dropdown-menu a):not(.footer-section a):hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Message/Alert Animations */
        .alert {
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 8px;
            animation: slideInLeft 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-left: 4px solid;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-color: #28a745;
        }
        
        .alert-error,
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-color: #dc3545;
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            color: #0c5460;
            border-color: #17a2b8;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeeba 100%);
            color: #856404;
            border-color: #ffc107;
        }

        /* Loading/Spinner Animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .spinner {
            animation: spin 1s linear infinite;
        }

        /* Hover Link Effect */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .shimmer-animation {
            background-image: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.2) 50%, transparent 100%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }

        /* Smooth Page Transitions */
        body.page-transition {
            opacity: 0;
            animation: fadeIn 0.6s ease 0.3s forwards;
        }

        /* ==================== MOBILE MENU STYLES ==================== */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            z-index: 200;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle:hover {
            transform: scale(1.1);
        }

        .mobile-menu-toggle.active span {
            animation: rotateToggle 0.3s ease forwards;
        }

        @keyframes rotateToggle {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(90deg);
            }
        }

        .mobile-nav {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            z-index: 150;
            padding: 100px 20px 20px;
            overflow-y: auto;
            animation: slideInDown 0.3s ease;
        }

        .mobile-nav.active {
            display: block;
        }

        .mobile-nav ul {
            list-style: none;
        }

        .mobile-nav li {
            margin: 15px 0;
        }

        .mobile-nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            display: block;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
            animation: slideInLeft 0.5s ease backwards;
        }

        .mobile-nav li:nth-child(1) a { animation-delay: 0.1s; }
        .mobile-nav li:nth-child(2) a { animation-delay: 0.2s; }
        .mobile-nav li:nth-child(3) a { animation-delay: 0.3s; }
        .mobile-nav li:nth-child(4) a { animation-delay: 0.4s; }
        .mobile-nav li:nth-child(5) a { animation-delay: 0.5s; }

        .mobile-nav a:hover {
            background: #667eea;
            transform: translateX(10px);
        }

        .mobile-nav a.active {
            color: #ff0000;
            background: rgba(255, 0, 0, 0.1);
            border-left: 3px solid #ff0000;
        }

        /* Show mobile menu toggle on small screens */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }

            .nav {
                display: none !important;
            }

            .header-icons {
                gap: 15px !important;
            }

            .header-content {
                justify-content: space-between;
            }

            main {
                padding-top: 20px;
            }
        }

        /* ==================== ENHANCED RESPONSIVE ANIMATIONS ==================== */

        /* Fade in animation for elements */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Bounce animation for interactive elements */
        @keyframes bounceIn {
            0%, 20%, 40%, 60%, 80%, 100% {
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }
            0% {
                opacity: 0;
                transform: translate3d(-3000px, 0, 0);
            }
            60% {
                opacity: 1;
                transform: translate3d(25px, 0, 0);
            }
            75% {
                transform: translate3d(-10px, 0, 0);
            }
            90% {
                transform: translate3d(5px, 0, 0);
            }
            100% {
                transform: translate3d(0, 0, 0);
            }
        }

        /* Smooth transitions for all interactive elements */
        .btn, button, a, input, textarea, select {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* Entrance animations for content sections */
        .hero-banner-section {
            animation: fadeIn 0.8s ease-out;
        }

        .featured-section,
        .new-arrivals-section,
        .categories-showcase {
            animation: fadeInScale 0.8s ease-out;
        }

        /* Responsive text animations */
        @media (max-width: 768px) {
            .hero-title, .hero-subtitle {
                animation-duration: 0.6s;
            }

            .section-title, .section-title-modern {
                animation-duration: 0.6s;
            }

            .product-card, .category-card {
                animation-duration: 0.5s;
            }
        }

        /* Tablet optimizations */
        @media (min-width: 769px) and (max-width: 1024px) {
            .products-carousel-wrapper {
                padding: 0 40px;
            }

            .carousel-control {
                width: 45px;
                height: 45px;
            }
        }

        /* Ultra-wide screen optimizations */
        @media (min-width: 1920px) {
            .container {
                max-width: 1400px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }

            .section-title {
                font-size: 48px;
            }

            .product-card {
                flex: 0 0 280px;
            }
        }

        /* Print media - no animations */
        @media print {
            * {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="header-top">
        🎁 Shop for ₹2999 or above and get ₹300 WORTH PREMIUM GIFTS | Free Mystery gift on every order above ₹1499
    </div>

    <div class="header">
        <div class="header-top" style="background: linear-gradient(90deg, #ff0000 0%, #cc0000 100%); padding: 10px 0; text-align: center; font-size: 12px; color: white;">
            🎁 Shop for ₹2999 or above and get ₹300 WORTH PREMIUM GIFTS | Free Mystery gift on every order above ₹1499
        </div>
        
        <div style="background: #000; padding: 15px 0;">
            <div class="header-content" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="logo" style="display: flex; align-items: center; gap: 10px; font-size: 28px;">
                    <span style="font-size: 32px;">✨</span>
                    <div>
                        <span class="logo-text-main" style="font-size: 20px; letter-spacing: 2px;">ANIME</span><br>
                        <span class="logo-text-red" style="font-size: 18px; letter-spacing: 1px;">ARTISTRY</span>
                    </div>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <span>☰</span>
                </button>
                
                <!-- Main Navigation -->
                <nav style="flex: 1; margin: 0 40px;">
                    <ul class="nav" style="flex-wrap: wrap;">
                        <li><a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a></li>
                        
                        <!-- Category Dropdowns -->
                        @php
                            $categories = \App\Models\Category::where('is_active', 1)->get();
                        @endphp
                        @foreach($categories as $category)
                            <li style="position: relative;">
                                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="dropdown-toggle">
                                    {{ $category->name }}
                                </a>
                                @if($category->products->count() > 0)
                                    <div class="dropdown-menu" style="min-width: 220px;">
                                        @foreach($category->products->take(8) as $product)
                                            <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                        @endforeach
                                        @if($category->products->count() > 8)
                                            <a href="{{ route('products.index', ['category' => $category->id]) }}" style="color: #ff0000; font-weight: bold;">View All</a>
                                        @endif
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        
                        <li><a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a></li>
                        <li><a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a></li>
                    </ul>
                </nav>

                <!-- Mobile Navigation -->
                <nav class="mobile-nav" id="mobileNav">
                    <ul>
                        <li><a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a></li>
                        
                        @php
                            $categories = \App\Models\Category::where('is_active', 1)->get();
                        @endphp
                        @foreach($categories as $category)
                            <li><a href="{{ route('products.index', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                        @endforeach
                        
                        <li><a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a></li>
                        <li><a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a></li>
                    </ul>
                </nav>
                
                <!-- Right Icons -->
                <div class="header-icons" style="display: flex; gap: 20px; align-items: center;">
                    <a href="#" style="color: white; font-size: 20px; text-decoration: none;">🔍</a>
                    <a href="{{ route('admin.login') }}" style="color: white; font-size: 20px; text-decoration: none;">👤</a>
                    <a href="#" style="color: white; font-size: 20px; text-decoration: none;">❤️</a>
                    <a href="{{ route('cart.view') }}" class="icon-link" style="color: white; font-size: 20px; position: relative;">
                        🛒
                        @php
                            $cart = session()->get('cart', []);
                            $count = count($cart);
                        @endphp
                        @if ($count > 0)
                            <span class="cart-count">{{ $count }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>

        <!-- Category Circles Section - Compact Design -->
        <div style="background: #000; border-top: 1px solid #222; padding: 25px 0 35px 0; overflow: hidden;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
                <!-- Centered Flex Container -->
                <div id="categoryScroll" style="
                    display: flex;
                    justify-content: center;
                    align-items: flex-start;
                    gap: 25px;
                    flex-wrap: nowrap;
                    overflow-x: auto;
                    overflow-y: hidden;
                    scroll-behavior: smooth;
                    padding: 10px 5px;
                    scrollbar-width: none;
                    -ms-overflow-style: none;
                ">
                    @php
                        $categories = \App\Models\Category::where('is_active', 1)->orderBy('sort_order')->get();
                    @endphp
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" style="
                            text-decoration: none;
                            color: inherit;
                            text-align: center;
                            flex: 0 0 auto;
                            width: 90px;
                            transition: transform 0.3s ease;
                        "
                        onmouseover="this.style.transform='translateY(-5px)'"
                        onmouseout="this.style.transform='translateY(0)'">
                            <!-- Circle Container -->
                            <div style="
                                position: relative;
                                width: 80px;
                                height: 80px;
                                margin: 0 auto 10px;
                                border-radius: 50%;
                                overflow: hidden;
                                box-shadow: 0 3px 10px rgba(0,0,0,0.4);
                                transition: all 0.3s ease;
                                cursor: pointer;
                                border: 2px solid rgba(102, 126, 234, 0.3);
                                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                            " 
                            class="category-circle"
                            onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 6px 20px rgba(102, 126, 234, 0.6)'; this.style.borderColor='#667eea'" 
                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 3px 10px rgba(0,0,0,0.4)'; this.style.borderColor='rgba(102, 126, 234, 0.3)'">
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; text-align: center; font-size: 11px; padding: 8px; line-height: 1.2;">
                                        {{ $category->name }}
                                    </div>
                                @endif
                            </div>
                            <!-- Category Name -->
                            <p style="
                                font-size: 11px;
                                font-weight: 600;
                                color: white;
                                margin: 0;
                                padding: 0;
                                word-break: break-word;
                                line-height: 1.3;
                                max-width: 90px;
                                text-align: center;
                                transition: color 0.3s ease;
                            "
                            onmouseover="this.style.color='#ff0000'"
                            onmouseout="this.style.color='white'">
                                {{ $category->name }}
                            </p>
                        </a>
                    @endforeach
                </div>
                
                <!-- Navigation Arrows (Optional - only show if many categories) -->
                @if($categories->count() > 8)
                <button onclick="document.getElementById('categoryScroll').scrollLeft -= 300" style="
                    position: absolute;
                    left: 0;
                    top: 50%;
                    transform: translateY(-50%);
                    background: rgba(255, 0, 0, 0.8);
                    border: none;
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 20px;
                    color: white;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                    z-index: 10;
                    transition: all 0.3s ease;
                "
                onmouseover="this.style.background='rgba(255, 0, 0, 1)'; this.style.transform='translateY(-50%) scale(1.1)'"
                onmouseout="this.style.background='rgba(255, 0, 0, 0.8)'; this.style.transform='translateY(-50%) scale(1)'">
                    ❮
                </button>
                
                <button onclick="document.getElementById('categoryScroll').scrollLeft += 300" style="
                    position: absolute;
                    right: 0;
                    top: 50%;
                    transform: translateY(-50%);
                    background: rgba(255, 0, 0, 0.8);
                    border: none;
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 20px;
                    color: white;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                    z-index: 10;
                    transition: all 0.3s ease;
                "
                onmouseover="this.style.background='rgba(255, 0, 0, 1)'; this.style.transform='translateY(-50%) scale(1.1)'"
                onmouseout="this.style.background='rgba(255, 0, 0, 0.8)'; this.style.transform='translateY(-50%) scale(1)'">
                    ❯
                </button>
                @endif
            </div>
        </div>
        
        <!-- Hide scrollbar for category scroll -->
        <style>
            #categoryScroll::-webkit-scrollbar {
                display: none;
            }
            
            .category-circle:hover img {
                transform: scale(1.1);
            }
        </style>
    </div>
    </div>

    <main>
        @if ($errors->any())
            <div class="container">
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container">
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Customer Area</h3>
                <ul>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">My Orders</a></li>
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Wishlist</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>About ANIME ARTISTRY</h3>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Refund Policy</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p style="color: #ccc; font-size: 14px;">
                    📞 +91 97809 93395<br>
                    📧 info@printingnova.com<br>
                    📍 Kolkata, India - 743144
                </p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2026 ANIME ARTISTRY. All rights reserved. | Designed with ❤️ for anime lovers</p>
        </div>
    </footer>

    <!-- Animated Scrollbar Character -->
    <div id="scrollbar-character" style="
        position: fixed;
        right: 12px;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        z-index: 999;
        pointer-events: none;
        animation: float 3s ease-in-out infinite;
        filter: drop-shadow(0 0 8px rgba(102, 126, 234, 0.6));
    ">🚀</div>

    <script>
        // Animated Scrollbar Character
        const character = document.getElementById('scrollbar-character');
        
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) : 0;
            
            // Position character along scrollbar
            const scrollbarTop = scrollPercent * (window.innerHeight - 24);
            character.style.top = scrollbarTop + 'px';
            
            // Add rotation animation based on scroll speed
            const scrollSpeed = Math.abs(scrollTop - (window.lastScrollTop || 0));
            character.style.transform = `rotate(${scrollSpeed * 2}deg)`;
            
            window.lastScrollTop = scrollTop;
        });

        // Change character based on scroll position
        window.addEventListener('scroll', () => {
            const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) || 0;
            
            // Different characters at different positions
            if (scrollPercent < 0.25) {
                character.textContent = '🚀';
            } else if (scrollPercent < 0.5) {
                character.textContent = '⭐';
            } else if (scrollPercent < 0.75) {
                character.textContent = '💫';
            } else {
                character.textContent = '🎯';
            }
        });

        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Page transition animation
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('page-transition');
        });

        // Add animation to elements on scroll into view
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeIn 0.8s ease forwards';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all product cards and section titles
        document.querySelectorAll('.product-card, .section-title, .category-card').forEach(el => {
            el.style.opacity = '0';
            observer.observe(el);
        });

        // ==================== MOBILE MENU TOGGLE ==================== //
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileNav = document.getElementById('mobileNav');

        // Toggle mobile menu
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileNav.classList.toggle('active');
                mobileMenuToggle.classList.toggle('active');
            });
        }

        // Close mobile menu when a link is clicked
        if (mobileNav) {
            const navLinks = mobileNav.querySelectorAll('a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileNav.classList.remove('active');
                    mobileMenuToggle.classList.remove('active');
                });
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideNav = mobileNav && mobileNav.contains(event.target);
            const isClickOnToggle = mobileMenuToggle && mobileMenuToggle.contains(event.target);
            
            if (!isClickInsideNav && !isClickOnToggle && mobileNav && mobileNav.classList.contains('active')) {
                mobileNav.classList.remove('active');
                if (mobileMenuToggle) {
                    mobileMenuToggle.classList.remove('active');
                }
            }
        });

        // Prevent body scroll when mobile menu is open
        if (mobileNav) {
            const observer = new MutationObserver(() => {
                if (mobileNav.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = 'auto';
                }
            });

            observer.observe(mobileNav, { attributes: true, attributeFilter: ['class'] });
        }
    </script>
</body>
</html>
