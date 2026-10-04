<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('checkout', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:20',
            'emailAddress' => 'required|email|max:255',
            'streetAddress' => 'required|string|max:500',
            'landmark' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
            'deliveryNotes' => 'nullable|string|max:1000',
            'paymentMethod' => 'nullable|string',
            'items' => 'required',
            'subtotal' => 'required|numeric',
            'discountAmount' => 'nullable|numeric',
            'couponCode' => 'nullable|string',
            'shippingAmount' => 'nullable|numeric',
            'giftWrapAmount' => 'nullable|numeric',
            'totalAmount' => 'required|numeric',
        ]);

        $items = is_string($request->items) ? json_decode($request->items, true) : $request->items;

        if (empty($items)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Your cart is empty.'], 422);
            }
            return back()->withErrors(['items' => 'Your cart is empty.']);
        }

        DB::beginTransaction();
        try {
            $orderNumber = 'HIM-' . strtoupper(substr(uniqid(), -6));

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => Auth::id(),
                'customer_name' => $validated['fullName'],
                'customer_email' => $validated['emailAddress'],
                'customer_phone' => $validated['phoneNumber'],
                'street_address' => $validated['streetAddress'],
                'landmark' => $validated['landmark'] ?? null,
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'delivery_notes' => $validated['deliveryNotes'] ?? null,
                'payment_method' => $validated['paymentMethod'] ?? 'cod',
                'payment_status' => ($validated['paymentMethod'] ?? 'cod') === 'cod' ? 'pending' : 'paid',
                'order_status' => 'confirmed',
                'subtotal' => $validated['subtotal'],
                'discount_amount' => $validated['discountAmount'] ?? 0.00,
                'coupon_code' => $validated['couponCode'] ?? null,
                'shipping_amount' => $validated['shippingAmount'] ?? 0.00,
                'gift_wrap_amount' => $validated['giftWrapAmount'] ?? 0.00,
                'total_amount' => $validated['totalAmount'],
            ]);

            foreach ($items as $item) {
                // Find matching product if possible
                $productId = null;
                if (!empty($item['productId'])) {
                    $prod = Product::where('id', $item['productId'])->orWhere('code', $item['productId'])->first();
                    if ($prod) {
                        $productId = $prod->id;
                    }
                }

                $qty = (int)($item['quantity'] ?? 1);
                $unitPrice = (float)($item['price'] ?? 0);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $item['name'] ?? 'Handcrafted Jewelry',
                    'metal' => $item['metal'] ?? null,
                    'size' => $item['size'] ?? null,
                    'price' => $unitPrice,
                    'quantity' => $qty,
                    'total' => $unitPrice * $qty,
                    'image' => $item['image'] ?? null,
                ]);
            }

            DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully!',
                    'order_number' => $orderNumber,
                    'order_id' => $order->id,
                ]);
            }

            return redirect()->route('checkout.confirmation', ['orderNumber' => $orderNumber])
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => 'Failed to place order: ' . $e->getMessage()]);
        }
    }

    public function orderConfirmation($orderNumber)
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();
        return view('checkout', ['confirmedOrder' => $order]);
    }
}
