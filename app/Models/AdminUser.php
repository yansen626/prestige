<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AdminUser
 * 
 * @property int $id
 * @property int $is_super_admin
 * @property int $role_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $language
 * @property string $image_path
 * @property string $remember_token
 * @property \Carbon\Carbon $email_verified_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $status_id
 * 
 * @property \App\Models\Role $role
 * @property \App\Models\Status $status
 *
 * @package App\Models
 */
class AdminUser extends Authenticatable
{
    protected $guard = 'admin';

	protected $casts = [
		'is_super_admin' => 'int',
		'role_id' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'is_super_admin',
		'role_id',
		'first_name',
		'last_name',
		'email',
		'password',
		'language',
		'image_path',
		'remember_token',
		'email_verified_at',
        'status_id'
	];

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class);
    }

	public function role()
	{
		return $this->belongsTo(\App\Models\Role::class);
	}
}
