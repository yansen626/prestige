<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 12 Dec 2018 04:31:58 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProductPosition
 * 
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property int $pos_x
 * @property int $pos_y
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class ProductPosition extends Eloquent
{
	protected $casts = [
		'product_id' => 'int',
		'pos_x' => 'int',
		'pos_y' => 'int'
	];

	protected $fillable = [
		'product_id',
		'name',
		'pos_x',
		'pos_y'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
