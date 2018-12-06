<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderHistory
 * 
 * @property int $id
 * @property int $order_id
 * @property int $order_status_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Order $order
 * @property \App\Models\AvoredOrderStatus $avored_order_status
 *
 * @package App\Models
 */
class OrderHistory extends Eloquent
{
	protected $casts = [
		'order_id' => 'int',
		'order_status_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'order_status_id'
	];

	public function order()
	{
		return $this->belongsTo(\App\Models\Order::class);
	}

	public function avored_order_status()
	{
		return $this->belongsTo(\App\Models\AvoredOrderStatus::class, 'order_status_id');
	}
}
