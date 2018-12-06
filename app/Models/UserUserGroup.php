<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserUserGroup
 * 
 * @property int $id
 * @property int $user_id
 * @property int $user_group_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\UserGroup $user_group
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class UserUserGroup extends Eloquent
{
	protected $table = 'user_user_group';

	protected $casts = [
		'user_id' => 'int',
		'user_group_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'user_group_id'
	];

	public function user_group()
	{
		return $this->belongsTo(\App\Models\UserGroup::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
