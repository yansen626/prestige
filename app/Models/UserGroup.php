<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserGroup
 * 
 * @property int $id
 * @property string $name
 * @property int $is_default
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class UserGroup extends Eloquent
{
	protected $casts = [
		'is_default' => 'int'
	];

	protected $fillable = [
		'name',
		'is_default'
	];

	public function users()
	{
		return $this->belongsToMany(\App\Models\User::class)
					->withPivot('id')
					->withTimestamps();
	}
}
