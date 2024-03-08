<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    // In the Discount model
protected $table = 'discounts';

protected $fillable = [
    'product_id', 'title', 'percentage', 'start_date', 'end_date', 'status',
];
public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
