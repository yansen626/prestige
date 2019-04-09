<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Apr 2019 04:18:07 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderBankTransfer
 * 
 * @property int $id
 * @property int $order_id
 * @property string $bank_acc_no
 * @property string $bank_acc_name
 * @property string $bank_name
 * @property int $amount
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_by
 * @property \Carbon\Carbon $updated_by
 * 
 * @property \App\Models\Order $order
 *
 * @package App\Models
 */
class OrderBankTransfer extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'order_id' => 'int',
		'amount' => 'int'
	];

	protected $dates = [
		'date',
		'created_by',
		'updated_by'
	];

	protected $fillable = [
		'order_id',
		'bank_acc_no',
		'bank_acc_name',
		'bank_name',
		'amount',
		'date',
		'created_by',
		'updated_by'
	];

	public function order()
	{
		return $this->belongsTo(\App\Models\Order::class);
	}
}
