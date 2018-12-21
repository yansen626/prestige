<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 21 Dec 2018 08:35:40 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cart
 * 
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $description
 * @property int $qty
 * @property float $price
 * @property float $total_price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Cart extends Eloquent
{
	protected $casts = [
		'user_id' => 'int',
		'product_id' => 'int',
		'qty' => 'int',
		'price' => 'float',
		'total_price' => 'float'
	];

	protected $fillable = [
		'user_id',
		'product_id',
		'description',
		'qty',
		'price',
		'total_price'
	];
}
