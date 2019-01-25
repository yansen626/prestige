<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 25 Jan 2019 08:03:44 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderNumber
 * 
 * @property string $id
 * @property int $next_no
 *
 * @package App\Models
 */
class OrderNumber extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'next_no' => 'int'
	];

	protected $fillable = [
	    'id',
		'next_no'
	];
}
