<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SiteCurrency
 * 
 * @property int $id
 * @property string $code
 * @property string $symbol
 * @property string $name
 * @property float $conversion_rate
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class SiteCurrency extends Eloquent
{
	protected $casts = [
		'conversion_rate' => 'float'
	];

	protected $fillable = [
		'code',
		'symbol',
		'name',
		'conversion_rate',
		'status'
	];
}
