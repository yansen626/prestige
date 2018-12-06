<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AvoredProductAttributeIntegerValue
 * 
 * @property int $id
 * @property int $attribute_id
 * @property int $product_id
 * @property int $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Attribute $attribute
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class AvoredProductAttributeIntegerValue extends Eloquent
{
	protected $casts = [
		'attribute_id' => 'int',
		'product_id' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
		'attribute_id',
		'product_id',
		'value'
	];

	public function attribute()
	{
		return $this->belongsTo(\App\Models\Attribute::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
