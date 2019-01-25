<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 31 Dec 2018 10:11:22 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Order
 * 
 * @property int $id
 * @property int $user_id
 * @property string $voucher_code
 * @property float $voucher_amount
 * @property int $billing_address_id
 * @property string $shipping_option
 * @property int $shipping_address_id
 * @property string $shipping_charge
 * @property string $payment_option
 * @property float $payment_charge
 * @property float $sub_total
 * @property float $tax_amount
 * @property float $grand_total
 * @property string $track_code
 * @property string $currency_code
 * @property int $order_status_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $order_number
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
		'user_id' => 'int',
		'billing_address_id' => 'int',
		'shipping_address_id' => 'int',
		'payment_charge' => 'float',
		'sub_total' => 'float',
		'tax_amount' => 'float',
		'grand_total' => 'float',
		'order_status_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'voucher_code',
		'voucher_amount',
		'billing_address_id',
		'shipping_option',
		'shipping_address_id',
		'shipping_charge',
		'payment_option',
		'payment_charge',
		'sub_total',
		'tax_amount',
		'grand_total',
		'track_code',
		'currency_code',
		'order_status_id',
        'order_number'
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

    public function order_products()
    {
        return $this->hasMany(\App\Models\OrderProduct::class);
    }

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class, 'order_products')
					->withPivot('id', 'qty', 'price', 'tax_amount', 'grand_total', 'product_info')
					->withTimestamps();
	}

	public function order_return_requests()
	{
		return $this->hasMany(\App\Models\OrderReturnRequest::class);
	}
}
