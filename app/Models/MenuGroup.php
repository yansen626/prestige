<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MenuGroup
 * 
 * @property int $id
 * @property string $name
 * @property string $identifier
 * @property int $is_default
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $menus
 *
 * @package App\Models
 */
class MenuGroup extends Eloquent
{
	protected $casts = [
		'is_default' => 'int'
	];

	protected $fillable = [
		'name',
		'identifier',
		'is_default'
	];

	public function menus()
	{
		return $this->hasMany(\App\Models\Menu::class);
	}
}
