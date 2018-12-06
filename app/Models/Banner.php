<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Banner
 * 
 * @property int $id
 * @property string $name
 * @property string $image_path
 * @property string $alt_text
 * @property string $url
 * @property string $target
 * @property string $status
 * @property int $sort_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Banner extends Eloquent
{
	protected $casts = [
		'sort_order' => 'int'
	];

	protected $fillable = [
		'name',
		'image_path',
		'alt_text',
		'url',
		'target',
		'status',
		'sort_order'
	];
}
