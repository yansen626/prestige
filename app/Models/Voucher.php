<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 12 Dec 2018 04:22:43 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Voucher
 * 
 * @property int $id
 * @property string $code
 * @property string $description
 * @property int $category_id
 * @property int $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $created_by
 * @property int $updated_by
 * 
 * @property \App\Models\AdminUser $admin_user
 *
 * @package App\Models
 */
class Voucher extends Eloquent
{
	protected $casts = [
		'category_id' => 'int',
		'product_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'code',
		'description',
		'category_id',
		'product_id',
		'created_by',
		'updated_by'
	];

	public function admin_user()
	{
		return $this->belongsTo(\App\Models\AdminUser::class, 'updated_by');
	}
}
