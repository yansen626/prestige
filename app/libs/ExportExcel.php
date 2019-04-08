<?php
/**
 * Created by PhpStorm.
 * User: YANSEN
 * Date: 4/8/2019
 * Time: 9:37
 */

namespace App\libs;

use App\Models\WaitingList;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class ExportExcel implements FromQuery
{
    use Exportable;
    public function query()
    {
        return WaitingList::query();
    }
}