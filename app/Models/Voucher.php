<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 12 Dec 2018 08:06:03 +0000.
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
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $finish_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status_id
 *
 * @property \App\Models\AdminUser $createdBy
 * @property \App\Models\AdminUser $updatedBy
 * @property \App\Models\Status $status
 *
 * @package App\Models
 */
class Voucher extends Eloquent
{
	protected $casts = [
		'category_id' => 'int',
		'product_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'status_id' => 'int'
	];

	protected $dates = [
		'start_date',
		'finish_date'
	];

	protected $fillable = [
		'code',
		'description',
		'category_id',
		'product_id',
		'start_date',
		'finish_date',
		'created_by',
		'updated_by',
		'status_id'
	];

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\AdminUser::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(\App\Models\AdminUser::class, 'updated_by');
    }

	public function status()
	{
		return $this->belongsTo(\App\Models\Status::class);
	}
}
