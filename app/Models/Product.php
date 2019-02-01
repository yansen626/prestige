<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 09 Jan 2019 04:31:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $type
 * @property int $category_id
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
 * @property string $colour
 * @property float $weight
 * @property float $width
 * @property float $height
 * @property float $length
 * @property string $meta_title
 * @property string $meta_description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Category $category
 * @property \Illuminate\Database\Eloquent\Collection $attributes
 * @property \Illuminate\Database\Eloquent\Collection $carts
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
		'category_id' => 'int',
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
		'category_id',
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
		'colour',
		'weight',
		'width',
		'height',
		'length',
		'meta_title',
		'meta_description'
	];

	protected $appends = [
	    'price_string',
        'cost_price_string'
    ];

    public function getPriceStringAttribute(){
        return number_format($this->attributes['price'], 0, ",", ".");
    }

    public function getCostPriceStringAttribute(){
        return number_format($this->attributes['cost_price'], 0, ",", ".");
    }

	public function category()
	{
		return $this->belongsTo(\App\Models\Category::class);
	}

	public function attributes()
	{
		return $this->belongsToMany(\App\Models\Attribute::class)
					->withPivot('id')
					->withTimestamps();
	}

	public function carts()
	{
		return $this->hasMany(\App\Models\Cart::class);
	}

	public function categories()
	{
		return $this->belongsToMany(\App\Models\Category::class)
					->withPivot('id')
					->withTimestamps();
	}

	public function orders()
	{
		return $this->belongsToMany(\App\Models\Order::class, 'order_products')
					->withPivot('id', 'qty', 'price', 'tax_amount', 'grand_total', 'product_info')
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
		return $this->belongsToMany(\App\Models\Property::class)
					->withPivot('id')
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
