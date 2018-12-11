<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 11 Dec 2018 08:39:58 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Province
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 * @property \Illuminate\Database\Eloquent\Collection $store_addresses
 *
 * @package App\Models
 */
class Province extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name'
	];

	public function addresses()
	{
		return $this->hasMany(\App\Models\Address::class, 'province');
	}

	public function store_addresses()
	{
		return $this->hasMany(\App\Models\StoreAddress::class, 'province');
	}
}
