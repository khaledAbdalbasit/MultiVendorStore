<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    use HasFactory;
    //protected $tabel = 'oredr_items';
    protected $table = 'order_items';
    public $incrementing = true;

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->withDefault(['nme' => 'product_name']);
    }

    public function oreder()
    {
        return $this->belongsTo(Oredr::class);
    }
}
