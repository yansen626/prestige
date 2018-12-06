<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderReturnRequest
 * 
 * @property int $id
 * @property int $order_id
 * @property string $status
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Order $order
 * @property \Illuminate\Database\Eloquent\Collection $order_return_products
 *
 * @package App\Models
 */
class OrderReturnRequest extends Eloquent
{
	protected $casts = [
		'order_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'status',
		'comment'
	];

	public function order()
	{
		return $this->belongsTo(\App\Models\Order::class);
	}

	public function order_return_products()
	{
		return $this->hasMany(\App\Models\OrderReturnProduct::class);
	}
}
