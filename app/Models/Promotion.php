<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Promotion
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $discount_type
 * @property float $amount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Promotion extends Eloquent
{
	protected $casts = [
		'amount' => 'float'
	];

	protected $fillable = [
		'name',
		'description',
		'discount_type',
		'amount'
	];
}
