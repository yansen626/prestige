<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProductReview
 * 
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property float $star
 * @property string $content
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Product $product
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class ProductReview extends Eloquent
{
	protected $casts = [
		'product_id' => 'int',
		'user_id' => 'int',
		'star' => 'float'
	];

	protected $fillable = [
		'product_id',
		'user_id',
		'star',
		'content',
		'status'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
