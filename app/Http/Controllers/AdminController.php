<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::sum('total_amount');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalInquiries = Inquiry::count();
        $totalUsers = User::count();

        $orders = Order::with('items')->latest()->get();
        $products = Product::latest()->get();
        $inquiries = Inquiry::latest()->get();
        $users = User::latest()->get();

        return view('admin', compact(
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'totalInquiries',
            'totalUsers',
            'orders',
            'products',
            'inquiries',
            'users'
        ));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'metal' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'badge' => 'nullable|string',
            'image' => 'nullable|string',
            'in_stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'artisan_notes' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['category_label'] = $validated['category'] === 'rings' ? 'Artisanal Rings' : 'Hand Bangles';
        $validated['code'] = strtolower(substr($validated['category'], 0, 4)) . '-' . rand(10, 99);
        $validated['image'] = $validated['image'] ?? 'assets/images/prod-solitaire-ring.jpg';
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sizes'] = $validated['category'] === 'rings' 
            ? ['US 5', 'US 6', 'US 7', 'US 8', 'US 9'] 
            : ['2.4 (Small)', '2.6 (Medium)', '2.8 (Large)'];
        $validated['available_metals'] = [$validated['metal']];

        Product::create($validated);

        return back()->with('success', 'Artisanal piece added to the catalog successfully!');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'metal' => 'required|string',
            'metal_key' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'badge' => 'nullable|string',
            'image' => 'nullable|string',
            'in_stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'artisan_notes' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['category_label'] = $validated['category'] === 'rings' ? 'Artisanal Rings' : 'Hand Bangles';
        $validated['is_featured'] = $request->boolean('is_featured');

        $product->update($validated);

        return back()->with('success', 'Product updated successfully!');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return back()->with('success', 'Product removed from collection.');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'order_status' => 'required|string|in:confirmed,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['order_status' => $request->order_status]);

        return back()->with('success', 'Order #' . $order->order_number . ' status updated to ' . ucfirst($request->order_status));
    }

    public function updateInquiryStatus(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $request->validate([
            'status' => 'required|string|in:new,read,replied',
        ]);

        $inquiry->update(['status' => $request->status]);

        return back()->with('success', 'Inquiry status updated.');
    }

    public function destroyInquiry($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();

        return back()->with('success', 'Inquiry deleted.');
    }
}
