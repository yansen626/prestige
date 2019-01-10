<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 10 Jan 2019 06:30:38 +0000.
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
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class ProductPosition extends Eloquent
{
	public $timestamps = false;

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
