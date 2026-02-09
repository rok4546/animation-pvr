<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
            'recent_orders' => Order::with('user')->latest()->take(10)->get(),
            'top_products' => Product::withCount('reviews')->orderByDesc('reviews_count')->take(5)->get(),
        ];
        
        return view('admin.dashboard', $data);
    }

    public function salesReport(Request $request)
    {
        $query = Order::with(['user', 'items.product']);
        
        // Filter by date range if provided
        if ($request->has('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->has('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        $orders = $query->latest()->paginate(50);
        
        $data = [
            'orders' => $orders,
            'total_sales' => Order::where('payment_status', 'paid')->sum('total'),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'cancelled_orders' => Order::where('status', 'cancelled')->count(),
        ];
        
        return view('admin.reports.sales', $data);
    }

    public function productsReport(Request $request)
    {
        $query = Product::withCount(['reviews', 'orderItems']);
        
        // Filter by category if provided
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        // Filter by stock status
        if ($request->has('stock_status')) {
            if ($request->stock_status === 'in_stock') {
                $query->where('stock', '>', 0);
            } elseif ($request->stock_status === 'out_of_stock') {
                $query->where('stock', '=', 0);
            } elseif ($request->stock_status === 'low_stock') {
                $query->where('stock', '>', 0)->where('stock', '<=', 10);
            }
        }
        
        $products = $query->latest()->paginate(50);
        $categories = Category::all();
        
        $data = [
            'products' => $products,
            'categories' => $categories,
            'total_products' => Product::count(),
            'in_stock' => Product::where('stock', '>', 0)->count(),
            'out_of_stock' => Product::where('stock', '=', 0)->count(),
            'low_stock' => Product::where('stock', '>', 0)->where('stock', '<=', 10)->count(),
        ];
        
        return view('admin.reports.products', $data);
    }

    public function inventoryReport(Request $request)
    {
        $query = Product::with('category');
        
        // Filter by category if provided
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        $products = $query->orderBy('stock', 'asc')->paginate(50);
        $categories = Category::all();
        
        $data = [
            'products' => $products,
            'categories' => $categories,
            'total_stock_value' => Product::selectRaw('SUM(price * stock) as total')->value('total'),
            'total_products' => Product::count(),
            'in_stock' => Product::where('stock', '>', 0)->count(),
            'out_of_stock' => Product::where('stock', '=', 0)->count(),
            'low_stock_items' => Product::where('stock', '>', 0)->where('stock', '<=', 10)->get(),
        ];
        
        return view('admin.reports.inventory', $data);
    }

    public function customersReport(Request $request)
    {
        $query = User::where('role', 'customer')
            ->withCount('orders')
            ->withSum('orders', 'total');
        
        // Filter by registration date if provided
        if ($request->has('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->has('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        $customers = $query->latest()->paginate(50);
        
        $data = [
            'customers' => $customers,
            'total_customers' => User::where('role', 'customer')->count(),
            'customers_with_orders' => User::where('role', 'customer')->has('orders')->count(),
            'total_customer_value' => Order::where('payment_status', 'paid')->sum('total'),
            'average_order_value' => Order::where('payment_status', 'paid')->avg('total'),
        ];
        
        return view('admin.reports.customers', $data);
    }
}

