<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 30 Dec 2018 08:10:31 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Address
 * 
 * @property int $id
 * @property int $user_id
 * @property string $description
 * @property int $primary
 * @property int $country_id
 * @property int $province_id
 * @property int $city_id
 * @property int $disctrict_id
 * @property string $state
 * @property string $street
 * @property string $suburb
 * @property string $postal_code
 * @property string $recipient_name
 * @property string $recipient_phone
 * @property string $name
 * 
 * @property \App\Models\City $city
 * @property \App\Models\Country $country
 * @property \App\Models\Province $province
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $orders
 *
 * @package App\Models
 */
class Address extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'primary' => 'int',
		'country_id' => 'int',
		'province_id' => 'int',
		'city_id' => 'int',
		'disctrict_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'description',
		'primary',
		'country_id',
		'province_id',
		'city_id',
		'disctrict_id',
		'state',
		'street',
		'suburb',
		'postal_code',
		'recipient_name',
		'recipient_phone',
		'name'
	];

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class);
	}

	public function country()
	{
		return $this->belongsTo(\App\Models\Country::class);
	}

	public function province()
	{
		return $this->belongsTo(\App\Models\Province::class);
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
