<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 11 Dec 2018 08:40:03 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class City
 * 
 * @property int $id
 * @property string $name
 * @property int $province_id
 * 
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 * @property \Illuminate\Database\Eloquent\Collection $store_addresses
 *
 * @package App\Models
 */
class City extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'province_id' => 'int'
	];

	protected $fillable = [
		'name',
		'province_id'
	];

	public function addresses()
	{
		return $this->hasMany(\App\Models\Address::class, 'city');
	}

	public function store_addresses()
	{
		return $this->hasMany(\App\Models\StoreAddress::class, 'city');
	}
}
