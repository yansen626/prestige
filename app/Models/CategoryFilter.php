<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CategoryFilter
 * 
 * @property int $id
 * @property int $category_id
 * @property string $type
 * @property int $filter_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Category $category
 *
 * @package App\Models
 */
class CategoryFilter extends Eloquent
{
	protected $casts = [
		'category_id' => 'int',
		'filter_id' => 'int'
	];

	protected $fillable = [
		'category_id',
		'type',
		'filter_id'
	];

	public function category()
	{
		return $this->belongsTo(\App\Models\Category::class);
	}
}
