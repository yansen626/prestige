<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 31 Dec 2018 04:50:31 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderProduct
 * 
 * @property int $id
 * @property int $product_id
 * @property int $order_id
 * @property int $qty
 * @property float $price
 * @property float $tax_amount
 * @property float $grand_total
 * @property string $product_info
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Order $order
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class OrderProduct extends Eloquent
{
	protected $casts = [
		'product_id' => 'int',
		'order_id' => 'int',
		'qty' => 'int',
		'price' => 'float',
		'tax_amount' => 'float',
		'grand_total' => 'float'
	];

	protected $fillable = [
		'product_id',
		'order_id',
		'qty',
		'price',
		'tax_amount',
		'grand_total',
		'product_info'
	];

	protected $appends = [
	    'price_string',
        'tax_amount_string',
        'grand_total_string'
    ];

    public function getPriceStringAttribute(){
        return number_format($this->attributes['price'], 0, ",", ".");
    }

    public function getTaxAmountStringAttribute(){
        return number_format($this->attributes['tax_amount'], 0, ",", ".");
    }

    public function getGrandTotalStringAttribute(){
        return number_format($this->attributes['grand_total'], 0, ",", ".");
    }

	public function order()
	{
		return $this->belongsTo(\App\Models\Order::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
