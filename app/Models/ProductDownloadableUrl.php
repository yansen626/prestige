<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProductDownloadableUrl
 * 
 * @property int $id
 * @property int $product_id
 * @property string $demo_path
 * @property string $main_path
 * @property string $token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class ProductDownloadableUrl extends Eloquent
{
	protected $casts = [
		'product_id' => 'int'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'product_id',
		'demo_path',
		'main_path',
		'token'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
