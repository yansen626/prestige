<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Menu
 * 
 * @property int $id
 * @property int $menu_group_id
 * @property int $parent_id
 * @property string $name
 * @property string $route
 * @property string $params
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\MenuGroup $menu_group
 *
 * @package App\Models
 */
class Menu extends Eloquent
{
	protected $casts = [
		'menu_group_id' => 'int',
		'parent_id' => 'int'
	];

	protected $fillable = [
		'menu_group_id',
		'parent_id',
		'name',
		'route',
		'params'
	];

	public function menu_group()
	{
		return $this->belongsTo(\App\Models\MenuGroup::class);
	}
}
