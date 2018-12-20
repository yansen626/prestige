<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 20 Dec 2018 03:51:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $slug
 * @property string $sku
 * @property string $tag
 * @property string $description
 * @property int $status
 * @property int $in_stock
 * @property int $track_stock
 * @property float $qty
 * @property int $is_taxable
 * @property float $price
 * @property float $cost_price
 * @property float $weight
 * @property float $width
 * @property float $height
 * @property float $length
 * @property string $meta_title
 * @property string $meta_description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $attributes
 * @property \Illuminate\Database\Eloquent\Collection $avored_product_images
 * @property \Illuminate\Database\Eloquent\Collection $categories
 * @property \Illuminate\Database\Eloquent\Collection $orders
 * @property \Illuminate\Database\Eloquent\Collection $order_return_products
 * @property \Illuminate\Database\Eloquent\Collection $product_downloadable_urls
 * @property \Illuminate\Database\Eloquent\Collection $product_images
 * @property \Illuminate\Database\Eloquent\Collection $product_positions
 * @property \Illuminate\Database\Eloquent\Collection $properties
 * @property \Illuminate\Database\Eloquent\Collection $product_reviews
 * @property \Illuminate\Database\Eloquent\Collection $product_variations
 * @property \Illuminate\Database\Eloquent\Collection $related_products
 * @property \Illuminate\Database\Eloquent\Collection $wishlists
 *
 * @package App\Models
 */
class Product extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'in_stock' => 'int',
		'track_stock' => 'int',
		'qty' => 'float',
		'is_taxable' => 'int',
		'price' => 'float',
		'cost_price' => 'float',
		'weight' => 'float',
		'width' => 'float',
		'height' => 'float',
		'length' => 'float'
	];

	protected $fillable = [
		'type',
		'name',
		'slug',
		'sku',
		'tag',
		'description',
		'status',
		'in_stock',
		'track_stock',
		'qty',
		'is_taxable',
		'price',
		'cost_price',
		'weight',
		'width',
		'height',
		'length',
		'meta_title',
		'meta_description'
	];

	public function attributes()
	{
		return $this->belongsToMany(\App\Models\Attribute::class, 'avored_product_attribute_integer_values')
					->withPivot('id', 'value')
					->withTimestamps();
	}

	public function avored_product_images()
	{
		return $this->hasMany(\App\Models\AvoredProductImage::class);
	}

	public function categories()
	{
		return $this->belongsToMany(\App\Models\Category::class)
					->withPivot('id')
					->withTimestamps();
	}

	public function orders()
	{
		return $this->belongsToMany(\App\Models\Order::class, 'order_product_variations')
					->withPivot('id', 'attribute_id', 'attribute_dropdown_option_id')
					->withTimestamps();
	}

	public function order_return_products()
	{
		return $this->hasMany(\App\Models\OrderReturnProduct::class);
	}

	public function product_downloadable_urls()
	{
		return $this->hasMany(\App\Models\ProductDownloadableUrl::class);
	}

	public function product_images()
	{
		return $this->hasMany(\App\Models\ProductImage::class);
	}

	public function product_positions()
	{
		return $this->hasMany(\App\Models\ProductPosition::class);
	}

	public function properties()
	{
		return $this->belongsToMany(\App\Models\Property::class, 'product_property_varchar_values')
					->withPivot('id', 'value')
					->withTimestamps();
	}

	public function product_reviews()
	{
		return $this->hasMany(\App\Models\ProductReview::class);
	}

	public function product_variations()
	{
		return $this->hasMany(\App\Models\ProductVariation::class, 'variation_id');
	}

	public function related_products()
	{
		return $this->hasMany(\App\Models\RelatedProduct::class, 'related_id');
	}

	public function wishlists()
	{
		return $this->hasMany(\App\Models\Wishlist::class);
	}
}
