<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CategoryProduct
 * 
 * @property int $id
 * @property int $category_id
 * @property int $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Category $category
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class CategoryProduct extends Eloquent
{
	protected $table = 'category_product';

	protected $casts = [
		'category_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'category_id',
		'product_id'
	];

	public function category()
	{
		return $this->belongsTo(\App\Models\Category::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
