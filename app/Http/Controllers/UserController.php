<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Wishlist;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($request->only('name', 'email', 'phone'));

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Show user orders
     */
    public function orders()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->paginate(10);
        return view('user.orders', compact('orders'));
    }

    /**
     * Show order details
     */
    public function orderDetails($id)
    {
        $order = Auth::user()->orders()->with('items.product')->findOrFail($id);
        return view('user.order-details', compact('order'));
    }

    /**
     * Show wishlist
     */
    public function wishlist()
    {
        $wishlistItems = Auth::user()->wishlists()->with('product')->latest()->get();
        return view('user.wishlist', compact('wishlistItems'));
    }

    /**
     * Add to wishlist
     */
    public function addToWishlist(Request $request, $productId)
    {
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->exists();

        if ($exists) {
            return back()->with('info', 'Product already in your wishlist!');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Product added to wishlist!');
    }

    /**
     * Remove from wishlist
     */
    public function removeFromWishlist($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return back()->with('success', 'Product removed from wishlist!');
    }

    /**
     * Show addresses
     */
    public function addresses()
    {
        $addresses = Auth::user()->shippingAddresses;
        return view('user.addresses', compact('addresses'));
    }

    /**
     * Store new address
     */
    public function storeAddress(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string',
            'address_line2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
        ]);

        // If this is set as default, unset other defaults
        if ($request->is_default) {
            ShippingAddress::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        ShippingAddress::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'is_default' => $request->is_default ?? false,
        ]);

        return back()->with('success', 'Address added successfully!');
    }

    /**
     * Delete address
     */
    public function deleteAddress($id)
    {
        ShippingAddress::where('user_id', Auth::id())->where('id', $id)->delete();
        return back()->with('success', 'Address deleted successfully!');
    }
}
