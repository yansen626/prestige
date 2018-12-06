<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Attribute
 * 
 * @property int $id
 * @property string $name
 * @property string $identifier
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $attribute_dropdown_options
 * @property \Illuminate\Database\Eloquent\Collection $products
 * @property \Illuminate\Database\Eloquent\Collection $order_product_variations
 *
 * @package App\Models
 */
class Attribute extends Eloquent
{
	protected $fillable = [
		'name',
		'identifier'
	];

	public function attribute_dropdown_options()
	{
		return $this->hasMany(\App\Models\AttributeDropdownOption::class);
	}

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class, 'avored_product_attribute_integer_values')
					->withPivot('id', 'value')
					->withTimestamps();
	}

	public function order_product_variations()
	{
		return $this->hasMany(\App\Models\OrderProductVariation::class);
	}
}
