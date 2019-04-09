<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Apr 2019 04:35:51 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OrderBankTransfer
 * 
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property string $bank_acc_no
 * @property string $bank_acc_name
 * @property string $bank_name
 * @property int $amount
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Order $order
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class OrderBankTransfer extends Eloquent
{
	protected $casts = [
		'user_id' => 'int',
		'order_id' => 'int',
		'amount' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'user_id',
		'order_id',
		'bank_acc_no',
		'bank_acc_name',
		'bank_name',
		'amount',
		'date'
	];

	public function order()
	{
		return $this->belongsTo(\App\Models\Order::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
