<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $product = Product::where("slug", $product->slug)->get();
        $relatedProducts = Product::where("category_id", $product[0]->category_id)->where("id", '!=', $product[0]->id)->limit(4)->get();
        return view("product-detail", [
            "product" => $product,
            "related_products" => $relatedProducts
        ]);
    }

    public function cart() {
        $products = session()->has("cart") ? session()->get("cart") : [];
        return view("cart", [
            "products" => $products
        ]);
    }

    public function addToCart(Product $product, Request $request) {
        $cart = session()->has("cart") ? session()->get("cart") : [];
        $qty = $request->has("qty") ? request()->get("qty") : 1;
        foreach ($cart as $item){
            if ($item->id == $product->id){
                $item->buy_qty = $item->buy_qty+1;
                session(["cart"=>$cart]);
                return redirect()->to("/cart");
            }
        }
        foreach ($cart as $item){
            $total += $item->price * $item->buy_qty;
        }
        $product->buy_qty = 1;
        $cart[] = $product;
        session(["cart"=>$cart]);
        return redirect()->to("/cart");
    }
}
