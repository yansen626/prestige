<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AvoredOrderStatus
 * 
 * @property int $id
 * @property string $name
 * @property int $is_default
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $order_histories
 * @property \Illuminate\Database\Eloquent\Collection $orders
 *
 * @package App\Models
 */
class AvoredOrderStatus extends Eloquent
{
	protected $casts = [
		'is_default' => 'int'
	];

	protected $fillable = [
		'name',
		'is_default'
	];

	public function order_histories()
	{
		return $this->hasMany(\App\Models\OrderHistory::class, 'order_status_id');
	}

	public function orders()
	{
		return $this->hasMany(\App\Models\Order::class, 'order_status_id');
	}
}
