<?php
namespace App\CustomClass;

use App\UserLinks;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportLinks implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows) {
        return $rows[0];
    }

    public function headingRow():int {
        return 2;   
    }
}

?>