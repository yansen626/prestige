<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Address
 * 
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $first_name
 * @property string $last_name
 * @property string $address1
 * @property string $address2
 * @property string $postcode
 * @property string $city
 * @property string $state
 * @property int $country_id
 * @property string $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Country $country
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $orders
 *
 * @package App\Models
 */
class Address extends Eloquent
{
	protected $casts = [
		'user_id' => 'int',
		'country_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'type',
		'first_name',
		'last_name',
		'address1',
		'address2',
		'postcode',
		'city',
		'state',
		'country_id',
		'phone'
	];

	public function country()
	{
		return $this->belongsTo(\App\Models\Country::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function orders()
	{
		return $this->hasMany(\App\Models\Order::class, 'shipping_address_id');
	}
}
