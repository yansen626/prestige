<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 07 Dec 2018 08:44:47 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Status
 * 
 * @property int $id
 * @property string $description
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Status extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'description'
	];

	public function users()
	{
		return $this->hasMany(\App\Models\User::class);
	}
}
