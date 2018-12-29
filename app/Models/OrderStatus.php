<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 29 Dec 2018 02:57:20 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderStatus
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
class OrderStatus extends Eloquent
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
		return $this->hasMany(\App\Models\OrderHistory::class);
	}

	public function orders()
	{
		return $this->hasMany(\App\Models\Order::class);
	}
}
