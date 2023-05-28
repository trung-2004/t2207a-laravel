<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";

    protected $fillable = [
        "name",
        "slug"
    ];
    public function products() {
        // mqh 1-n
        return $this->hasMany(Product::class);
    }
}
