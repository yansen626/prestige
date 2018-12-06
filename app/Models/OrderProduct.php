<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
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
	protected $table = 'order_product';

	protected $casts = [
		'product_id' => 'int',
		'order_id' => 'int',
		'qty' => 'int',
		'price' => 'float',
		'tax_amount' => 'float'
	];

	protected $fillable = [
		'product_id',
		'order_id',
		'qty',
		'price',
		'tax_amount',
		'product_info'
	];

	public function order()
	{
		return $this->belongsTo(\App\Models\Order::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
