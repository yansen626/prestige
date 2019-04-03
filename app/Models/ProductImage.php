<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 11 Dec 2018 14:00:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProductImage
 * 
 * @property int $id
 * @property int $product_id
 * @property string $path
 * @property bool $is_main_image
 * @property bool $is_thumbnail
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class ProductImage extends Eloquent
{
	protected $casts = [
		'product_id' => 'int',
		'is_main_image' => 'bool',
		'is_thumbnail' => 'bool'
	];

	protected $fillable = [
		'product_id',
		'path',
		'is_thumbnail',
		'is_main_image'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
