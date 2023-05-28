<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        "firstname",
        "lastname",
        "country",
        "address",
        "city",
        "state",
        "postcode",
        "phone",
        "email",
        "total",
        "payment_method",
        "is_paid",
        "status"
    ];
    // các sp nằm trong đơn
    public function products(){
        // mqh n-n
        return $this->belongsToMany(Product::class, "order_products")->withPivot("buy_qty", "price");
    }
}
