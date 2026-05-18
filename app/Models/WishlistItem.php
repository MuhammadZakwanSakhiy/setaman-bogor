<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    use HasFactory;

    public $timestamps = false; // Only has created_at
    protected $fillable = ['wishlist_id', 'product_id'];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
