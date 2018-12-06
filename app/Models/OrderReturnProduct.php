<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderReturnProduct
 * 
 * @property int $id
 * @property int $order_return_request_id
 * @property int $product_id
 * @property int $qty
 * @property string $reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\OrderReturnRequest $order_return_request
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class OrderReturnProduct extends Eloquent
{
	protected $casts = [
		'order_return_request_id' => 'int',
		'product_id' => 'int',
		'qty' => 'int'
	];

	protected $fillable = [
		'order_return_request_id',
		'product_id',
		'qty',
		'reason'
	];

	public function order_return_request()
	{
		return $this->belongsTo(\App\Models\OrderReturnRequest::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
