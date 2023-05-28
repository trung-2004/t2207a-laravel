<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

    protected $fillable = [
        "name",
        "slug",
        "price",
        "thumbnail",
        "quantity",
        "description",
        "category_id"
    ];
    // các ơn hàng có sản phẩm
    public function orders() {
        // mqh n-n
        return $this->belongsToMany(Order::class, "order_products")->withPivot("buy_qty", "price");
    }

    public function category() {
        // đk: khóa ngoại đặt ở bảng mình
        return $this->belongsTo(Category::class);
    }
}
