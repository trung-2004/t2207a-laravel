<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin() {
        return view("admin-home");
    }

    public function orders() {
        $orders = Order::orderBy("id", "asc")->paginate(12);
        return view("admin-orders", [
            "orders" => $orders
        ]);
    }

    public function invoice(Order $order) {
        return view("admin-invoice", [
            "order" => $order
        ]);
    }
}
