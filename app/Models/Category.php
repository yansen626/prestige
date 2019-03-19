<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 06 Dec 2018 06:52:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Category
 * 
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_description
 * @property string $zoho_item_group_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $category_filters
 * @property \Illuminate\Database\Eloquent\Collection $products
 *
 * @package App\Models
 */
class Category extends Eloquent
{
	protected $casts = [
		'parent_id' => 'int'
	];

	protected $fillable = [
		'parent_id',
		'name',
		'slug',
		'meta_title',
		'meta_description',
        'zoho_item_group_id'
	];

	public function category_filters()
	{
		return $this->hasMany(\App\Models\CategoryFilter::class);
	}

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class)
					->withPivot('id')
					->withTimestamps();
	}
}
