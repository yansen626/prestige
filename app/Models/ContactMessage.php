<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 12 Dec 2018 03:08:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ContactMessage
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property \Carbon\Carbon $created_at
 *
 * @package App\Models
 */
class ContactMessage extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name',
		'email',
		'message',
        'created_at'
	];
}
