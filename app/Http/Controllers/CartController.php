<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function view()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;
        
        foreach ($cart as $product_id => $quantity) {
            $product = Product::find($product_id);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
                $total += $product->price * $quantity;
            }
        }
        
        return view('cart.view', compact('items', 'total', 'cart'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = $request->quantity ?? 1;
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }
        
        session()->put('cart', $cart);
        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $product_id)
    {
        $quantity = $request->quantity;
        $cart = session()->get('cart', []);
        
        if ($quantity <= 0) {
            unset($cart[$product_id]);
        } else {
            $cart[$product_id] = $quantity;
        }
        
        session()->put('cart', $cart);
        return back()->with('success', 'Cart updated!');
    }

    public function remove($product_id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product_id]);
        session()->put('cart', $cart);
        
        return back()->with('success', 'Product removed from cart!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty');
        }
        
        $items = [];
        $subtotal = 0;
        
        foreach ($cart as $product_id => $quantity) {
            $product = Product::find($product_id);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
                $subtotal += $product->price * $quantity;
            }
        }
        
        $tax = $subtotal * 0.18; // 18% GST
        $shipping = 50; // Fixed shipping cost
        $total = $subtotal + $tax + $shipping;
        
        return view('cart.checkout', compact('items', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
            'payment_method' => 'required|string',
            'customer_notes' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty');
        }

        // Calculate totals
        $subtotal = 0;
        $order_items = [];
        
        foreach ($cart as $product_id => $quantity) {
            $product = Product::find($product_id);
            if ($product) {
                $subtotal += $product->price * $quantity;
                $order_items[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'total' => $product->price * $quantity,
                ];
            }
        }

        $tax = $subtotal * 0.18;
        $shipping = 50;
        $total = $subtotal + $tax + $shipping;

        // Create order
        $order = Order::create([
            'user_id' => auth()->id() ?? null,
            'order_number' => 'ORD-' . time(),
            'guest_email' => $validated['customer_email'],
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_method' => $validated['payment_method'],
            'shipping_address' => $validated['shipping_address'],
            'billing_address' => $validated['billing_address'],
            'customer_notes' => $validated['customer_notes'] ?? null,
        ]);

        // Create order items
        foreach ($order_items as $item) {
            OrderItem::create(array_merge($item, ['order_id' => $order->id]));
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('order.confirmation', ['order' => $order->id])->with('success', 'Order placed successfully!');
    }

    public function confirmation($order)
    {
        $order = Order::with('items')->findOrFail($order);
        return view('cart.confirmation', compact('order'));
    }
}
