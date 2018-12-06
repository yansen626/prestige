<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $phone_code
 * @property string $currency_code
 * @property string $currency_symbol
 * @property string $lang_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 * @property \Illuminate\Database\Eloquent\Collection $states
 *
 * @package App\Models
 */
class Country extends Eloquent
{
	protected $fillable = [
		'code',
		'name',
		'phone_code',
		'currency_code',
		'currency_symbol',
		'lang_code'
	];

	public function addresses()
	{
		return $this->hasMany(\App\Models\Address::class);
	}

	public function states()
	{
		return $this->hasMany(\App\Models\State::class);
	}
}
