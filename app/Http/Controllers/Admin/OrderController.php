<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $query = Order::with('user');
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->search) {
            $query->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhere('guest_email', 'like', '%' . $request->search . '%');
        }
        
        $orders = $query->latest()->paginate(20);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);
        
        $order->update($validated);
        return back()->with('success', 'Order status updated successfully');
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:unpaid,paid,failed',
        ]);
        
        $order->update($validated);
        return back()->with('success', 'Payment status updated successfully');
    }

    public function updateTracking(Request $request, Order $order)
    {
        $validated = $request->validate([
            'tracking_number' => 'nullable|string',
        ]);
        
        $order->update($validated);
        return back()->with('success', 'Tracking number updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }
}
