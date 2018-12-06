<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderProductVariation
 * 
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $attribute_id
 * @property int $attribute_dropdown_option_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\AttributeDropdownOption $attribute_dropdown_option
 * @property \App\Models\Attribute $attribute
 * @property \App\Models\Order $order
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class OrderProductVariation extends Eloquent
{
	protected $casts = [
		'order_id' => 'int',
		'product_id' => 'int',
		'attribute_id' => 'int',
		'attribute_dropdown_option_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'product_id',
		'attribute_id',
		'attribute_dropdown_option_id'
	];

	public function attribute_dropdown_option()
	{
		return $this->belongsTo(\App\Models\AttributeDropdownOption::class);
	}

	public function attribute()
	{
		return $this->belongsTo(\App\Models\Attribute::class);
	}

	public function order()
	{
		return $this->belongsTo(\App\Models\Order::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
