<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Property
 * 
 * @property int $id
 * @property string $name
 * @property string $identifier
 * @property string $data_type
 * @property string $field_type
 * @property int $use_for_all_products
 * @property int $is_visible_frontend
 * @property int $sort_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $products
 * @property \Illuminate\Database\Eloquent\Collection $property_dropdown_options
 *
 * @package App\Models
 */
class Property extends Eloquent
{
	protected $casts = [
		'use_for_all_products' => 'int',
		'is_visible_frontend' => 'int',
		'sort_order' => 'int'
	];

	protected $fillable = [
		'name',
		'identifier',
		'data_type',
		'field_type',
		'use_for_all_products',
		'is_visible_frontend',
		'sort_order'
	];

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class, 'product_property_varchar_values')
					->withPivot('id', 'value')
					->withTimestamps();
	}

	public function property_dropdown_options()
	{
		return $this->hasMany(\App\Models\PropertyDropdownOption::class);
	}
}
