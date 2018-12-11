<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 11 Dec 2018 08:40:17 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Disctrict
 * 
 * @property int $id
 * @property string $name
 *
 * @package App\Models
 */
class Disctrict extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];
}
