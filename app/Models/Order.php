<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 29 Dec 2018 03:05:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Order
 * 
 * @property int $id
 * @property string $shipping_option
 * @property string $payment_option
 * @property int $order_status_id
 * @property string $currency_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 * @property int $shipping_address_id
 * @property int $billing_address_id
 * @property string $track_code
 * 
 * @property \App\Models\Address $address
 * @property \App\Models\OrderStatus $order_status
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $order_histories
 * @property \Illuminate\Database\Eloquent\Collection $products
 * @property \Illuminate\Database\Eloquent\Collection $order_return_requests
 *
 * @package App\Models
 */
class Order extends Eloquent
{
	protected $casts = [
		'order_status_id' => 'int',
		'user_id' => 'int',
		'shipping_address_id' => 'int',
		'billing_address_id' => 'int'
	];

	protected $fillable = [
		'shipping_option',
		'payment_option',
		'order_status_id',
		'currency_code',
		'user_id',
		'shipping_address_id',
		'billing_address_id',
		'track_code'
	];

	public function address()
	{
		return $this->belongsTo(\App\Models\Address::class, 'shipping_address_id');
	}

	public function order_status()
	{
		return $this->belongsTo(\App\Models\OrderStatus::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function order_histories()
	{
		return $this->hasMany(\App\Models\OrderHistory::class);
	}

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class, 'order_product_variations')
					->withPivot('id', 'attribute_id', 'attribute_dropdown_option_id')
					->withTimestamps();
	}

	public function order_return_requests()
	{
		return $this->hasMany(\App\Models\OrderReturnRequest::class);
	}
}
