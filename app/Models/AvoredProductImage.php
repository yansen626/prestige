<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AvoredProductImage
 * 
 * @property int $id
 * @property int $product_id
 * @property string $path
 * @property bool $is_main_image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class AvoredProductImage extends Eloquent
{
	protected $casts = [
		'product_id' => 'int',
		'is_main_image' => 'bool'
	];

	protected $fillable = [
		'product_id',
		'path',
		'is_main_image'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
