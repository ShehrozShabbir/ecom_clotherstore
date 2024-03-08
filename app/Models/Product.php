<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'details', 'brand_id', 'category_id', 'size', 'selling_price', 'buying_price', 'status', 'stock_quantity', 'product_label', 'product_meta', 'discount'
    ];

    protected $casts = [
        'product_meta' => 'array',
    ];

    public function setProductMetaAttribute($value)
    {
        $this->attributes['product_meta'] = json_encode($value);
    }

    public function getProductMetaAttribute($value)
    {
        return json_decode($value, true);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
public function size()
    {
        return $this->belongsTo(size::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function discounts()
{
    return $this->hasMany(Discount::class);
}


}
