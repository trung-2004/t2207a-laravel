<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class WebController extends Controller
{
    public function home()
    {
        return view("welcome");
    }

    public function shop()
    {
        // take product in db
        //$new_product = Product::all();// take all product
        $new_product = Product::orderBy("id", "desc")->limit(6)->get();// take 6 product(limit), orderBy is sort product, method get() is take in
        $categories = Category::orderBy("id", "asc")->limit(10)->get();
        $products = Product::paginate(12);
        return view("shop-gird", [
            "new_products" => $new_product,
            "category" => $categories,
            "products_gird" => $products
        ]);
    }

    public function blog()
    {
        return view("blog");
    }

    public function search(Request $request)
    {
        $q = $request->get("q");// take data in url
        $limit = $request->has("limit") ? $request->get("limit") : 18;

        $categories = Category::orderBy("id", "asc")->limit(10)->get();
        $products = Product::where("name", "like", "%$q%")->paginate($limit);// search Product by name
        return view("searchProducts", [
            "category" => $categories,
            "products_gird" => $products
        ]);
    }

    public function category(Category $category)
    {
        // $category = Category::find($id);
        // if(category == null){
        // return abort
        // }
        //$category = Category::findOrFail($id);// dùng để nếu như ko tìm thấy id thì báo trang 404

        $categories = Category::orderBy("id", "asc")->limit(10)->get();
        $products = Product::where("category_id", $category->id)->paginate(18);

        return view("category", [
            "category" => $categories,
            "products_gird" => $products,
            "categoryfind" => $category
        ]);
    }

    public function product_detail(Product $product)
    {
        //$id = $request->get("id");
        $relatedProducts = Product::where("category_id", $product->category_id)->where("id", '!=', $product->id)->limit(4)->get();
        return view("product-detail", [
            "product" => $product,
            "related_products" => $relatedProducts
        ]);
    }

    public function cart()
    {
        $products = session()->has("cart") ? session()->get("cart") : [];
        $totals = 0;
        foreach ($products as $item) {
            $totals += $item->price * $item->buy_qty;
        }
        return view("cart", [
            "products" => $products,
            "totals" => $totals
        ]);
    }

    public function addToCart(Product $product, Request $request)
    {
        $cart = session()->has("cart") ? session()->get("cart") : [];
        $qty = $request->has("qty") ? request()->get("qty") : 1;
        foreach ($cart as $item) {
            if ($item->id == $product->id) {
                $item->buy_qty = $item->buy_qty + $qty;
                session(["cart" => $cart]);
                return redirect()->to("/cart");
            }
        }

        $product->buy_qty = $qty;
        $cart[] = $product;
        session(["cart" => $cart]);
        return redirect()->to("/cart");
    }

    public function checkOut()
    {
        $products = session()->has("cart") ? session()->get("cart") : [];
        $totals = 0;
        foreach ($products as $item) {
            $totals += $item->price * $item->buy_qty;
        }
        return view("check-out", [
            "products" => $products,
            "total" => $totals
        ]);

    }

    public function placeOrder(Request $request)
    {
        //kiểm tra validate phia backend(khoong thoa man se di ve giao dien cu)

        $request->validate([// mảng các quy tắt
            "firstname" => "required",
            "lastname" => "required",
            "address" => "required",
            "phone" => "required|min:10|max:12",// ít nhất 10 và nhiều nhất 12
            "email" => "required",
            "payment_method" => "required"
        ], [// mảng các thông điệp
            "required" => "Vui lòng điền đầy đủ thông tin",
            "min" => "Phải nhập tối thiểu :min",// min lấy từ trên xuống
            "max" => "Nhập giá trị không vượt quá :max",
        ]);

        $products = session()->has("cart") ? session()->get("cart") : [];
        $total = 0;
        foreach ($products as $item) {
            $total += $item->price * $item->buy_qty;
        }
        $order = Order::create([
            "firstname" => $request->get("firstname"),
            "lastname" => $request->get("lastname"),
            "country" => $request->get("country"),
            "address" => $request->get("address"),
            "city" => $request->get("city"),
            "state" => $request->get("state"),
            "postcode" => $request->get("postcode"),
            "phone" => $request->get("phone"),
            "email" => $request->get("email"),
            "total" => $total,
            "payment_method" => $request->get("payment_method"),
            //"is_paid"=>false,
            //"satus"=>0,
        ]);
        foreach ($products as $item) {
            DB::table("order_products")->insert([
                "order_id" => $order->id,
                "product_id" => $item->id,
                "buy_qty" => $item->buy_qty,
                "price" => $item->price
            ]);
        }

        // thanh toan bang paypal
        if ($order->payment_method == "PAYPAL") {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('successTransaction', ["order" => $order->id]),
                    "cancel_url" => route('cancelTransaction', ["order" => $order->id]),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => number_format($total, 2, ".", "")
                        ]
                    ]
                ]
            ]);

            if (isset($response['id']) && $response['id'] != null) {

                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }

            }
        } else if ($order->payment_method == "VNPAY") {
            // thanh toan = vnpay
        }
        // xóa giỏ hàng
        session()->forget("cart");
        // end
        return redirect()->to("/thank-you/" . $order->id);
    }

    public function thankYou(Order $order)
    {
        return view("invoice", [
            "order" => $order,
            "total" => $order->total
        ]);
    }

    public function successTransaction(Order $order, Request $request)
    {
        $order->update(["is_paid" => true, "satus" => 1]);// đã thanh toán, trạng thái về xác nhận
        return redirect()->to("/thank-you/" . $order->id);
    }

    public function cancelTransaction(Request $request)
    {
        return "error";
    }

    public function addToFavourite(Product $product)
    {
        $favourite = session()->has("favourite") ? session()->get("favourite") : [];

        foreach ($favourite as $item) {
            if ($item->id == $product->id) {

                return redirect()->to("/favourite");
            }
        }

        $favourite[] = $product;
        session(["favourite" => $favourite]);
        return redirect()->to("/favourite");
    }
    public function favourite()
    {
        $products = session()->has("favourite") ? session()->get("favourite") : [];
        return view("favourite", [
            "products" => $products,
        ]);
    }


}
