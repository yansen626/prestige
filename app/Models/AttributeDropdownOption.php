<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AttributeDropdownOption
 * 
 * @property int $id
 * @property int $attribute_id
 * @property string $display_text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Attribute $attribute
 * @property \Illuminate\Database\Eloquent\Collection $order_product_variations
 *
 * @package App\Models
 */
class AttributeDropdownOption extends Eloquent
{
	protected $casts = [
		'attribute_id' => 'int'
	];

	protected $fillable = [
		'attribute_id',
		'display_text'
	];

	public function attribute()
	{
		return $this->belongsTo(\App\Models\Attribute::class);
	}

	public function order_product_variations()
	{
		return $this->hasMany(\App\Models\OrderProductVariation::class);
	}
}
