<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 03 Apr 2019 03:38:59 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Voucher
 * 
 * @property int $id
 * @property string $code
 * @property string $description
 * @property int $voucher_percentage
 * @property float $voucher_amount
 * @property string $category_id
 * @property string $product_id
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $finish_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status_id
 * 
 * @property \App\Models\AdminUser $admin_user
 * @property \App\Models\Status $status
 *
 * @package App\Models
 */
class Voucher extends Eloquent
{
	protected $casts = [
		'voucher_percentage' => 'int',
		'voucher_amount' => 'float',
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
		'voucher_percentage',
		'voucher_amount',
		'category_id',
		'product_id',
		'start_date',
		'finish_date',
		'created_by',
		'updated_by',
		'status_id'
	];

    protected $appends = [
        'voucher_amount_string'
    ];

    public function getVoucherAmountStringAttribute(){
        return number_format($this->attributes['voucher_amount'], 0, ",", ".");
    }
	public function updatedBy()
	{
		return $this->belongsTo(\App\Models\AdminUser::class, 'updated_by');
	}
	public function createdBy()
	{
		return $this->belongsTo(\App\Models\AdminUser::class, 'created_by');
	}

	public function status()
	{
		return $this->belongsTo(\App\Models\Status::class);
	}
}
