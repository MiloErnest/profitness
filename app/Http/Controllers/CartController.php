<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use App\Models\Supplement;
use App\Models\SportClothes;
use App\Models\CafeteriaSale;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected function getCart()
    {
        return session()->get('cart', []);
    }

    protected function saveCart($cart): void
    {
        session(['cart' => $cart]);
    }

    public function index()
    {
        $cart = $this->getCart();
        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);

        return view('cart.index', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => 0,
            'total' => $subtotal,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'id' => 'required|integer',
            'qty' => 'nullable|integer|min:1',
        ]);

        $type = $request->input('type');
        $id = (int) $request->input('id');
        $qty = (int) ($request->input('qty', 1));

        $itemData = $this->resolveItem($type, $id);

        $cart = $this->getCart();
        $key = $type . ':' . $id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $qty;
        } else {
            $cart[$key] = [
                'key' => $key,
                'id' => $id,
                'type' => $type,
                'name' => $itemData['name'],
                'price' => $itemData['price'],
                'qty' => $qty,
            ];
        }

        $this->saveCart($cart);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'cart_count' => count($cart)]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'qty' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();
        $key = $request->input('key');

        if (isset($cart[$key])) {
            $cart[$key]['qty'] = (int) $request->input('qty');
            $this->saveCart($cart);
        }

        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $cart = $this->getCart();
        $key = $request->input('key');

        if (isset($cart[$key])) {
            unset($cart[$key]);
            $this->saveCart($cart);
        }

        return redirect()->route('cart.index');
    }

    public function clear()
    {
        $this->saveCart([]);

        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);

        return view('cart.checkout', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'tax' => 0,
            'total' => $subtotal,
        ]);
    }

    public function processCheckout(Request $request)
    {
        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:50',
        ]);

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);
        $tax = 0;
        $total = $subtotal + $tax;

        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'] ?? null,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'status' => 'paid',
            'payment_method' => 'simulado',
            'meta' => [
                'source' => 'web',
            ],
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_type' => $item['type'],
                'item_id' => $item['id'],
                'name' => $item['name'],
                'unit_price' => $item['price'],
                'quantity' => $item['qty'],
                'total' => $item['price'] * $item['qty'],
            ]);
        }

        $this->clear();

        return view('cart.success', [
            'order' => $order,
        ]);
    }

    protected function resolveItem(string $type, int $id): array
    {
        switch ($type) {
            case 'plan':
                $plan = MembershipPlan::findOrFail($id);
                return ['name' => $plan->name, 'price' => $plan->price];
            case 'supplement':
                $item = Supplement::findOrFail($id);
                return ['name' => $item->name, 'price' => $item->price];
            case 'sport_cloth':
                $item = SportClothes::findOrFail($id);
                return ['name' => $item->product_name, 'price' => $item->price];
            case 'cafeteria':
                $item = CafeteriaSale::findOrFail($id);
                return ['name' => $item->product_name, 'price' => $item->price];
            default:
                abort(404);
        }
    }
}
