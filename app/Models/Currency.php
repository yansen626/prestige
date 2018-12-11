<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 11 Dec 2018 04:34:48 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Currency
 * 
 * @property int $id
 * @property string $name
 * @property float $rate
 * @property \Carbon\Carbon $updated_at
 *
 * @property string $rate_string
 * @package App\Models
 */
class Currency extends Eloquent
{
    protected $appends = [
        'rate_string'
    ];

	public $timestamps = false;

	protected $casts = [
		'rate' => 'float'
	];

	protected $fillable = [
		'name',
		'rate'
	];

    public function getRateStringAttribute(){
        return number_format($this->attributes['rate'], 0, ",", ".");
    }
}
