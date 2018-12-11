<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 11 Dec 2018 08:54:16 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class StoreAddress
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $primary
 * @property int $province_id
 * @property int $city_id
 * @property int $disctrict_id
 * @property string $postal_code
 * @property \Carbon\Carbon $created_at
 * @property int $created_by
 * @property \Carbon\Carbon $updated_at
 * @property int $updated_by
 * 
 * @property \App\Models\AdminUser $createdBy
 * @property \App\Models\AdminUser $updatedBy
 * @property \App\Models\City $city
 * @property \App\Models\Province $province
 *
 * @package App\Models
 */
class StoreAddress extends Eloquent
{
	protected $casts = [
		'primary' => 'int',
		'province_id' => 'int',
		'city_id' => 'int',
		'disctrict_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'primary',
		'province_id',
		'city_id',
		'disctrict_id',
		'postal_code',
		'created_by',
		'updated_by'
	];

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\AdminUser::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(\App\Models\AdminUser::class, 'updated_by');
    }

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class);
	}

	public function province()
	{
		return $this->belongsTo(\App\Models\Province::class);
	}
}
