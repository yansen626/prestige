<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 06 Apr 2019 08:49:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class WaitingList
 * 
 * @property int $id
 * @property int $product_id
 * @property string $email
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class WaitingList extends Eloquent
{
	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'name',
		'email'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
