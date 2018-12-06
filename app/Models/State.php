<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class State
 * 
 * @property int $id
 * @property int $country_id
 * @property string $code
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Country $country
 *
 * @package App\Models
 */
class State extends Eloquent
{
	protected $casts = [
		'country_id' => 'int'
	];

	protected $fillable = [
		'country_id',
		'code',
		'name'
	];

	public function country()
	{
		return $this->belongsTo(\App\Models\Country::class);
	}
}
