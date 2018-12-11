<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 11 Dec 2018 04:34:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Currency
 * 
 * @property int $id
 * @property string $name
 * @property float $rate
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Currency extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'rate' => 'float'
	];

	protected $fillable = [
		'name',
		'rate'
	];
}
