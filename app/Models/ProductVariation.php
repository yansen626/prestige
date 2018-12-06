<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProductVariation
 * 
 * @property int $id
 * @property int $variation_id
 * @property int $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class ProductVariation extends Eloquent
{
	protected $casts = [
		'variation_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'variation_id',
		'product_id'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class, 'variation_id');
	}
}
