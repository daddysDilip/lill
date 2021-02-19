<?php
namespace App\CustomClass;

use App\UserLinks;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportLinks implements FromArray, WithHeadings
{

    public $List;

    public function __construct(array $List = []) { 
        $this->List = $List; 
    }

    public function array() :array
    {
        if(count($this->List) >0) return $this->List;
        return [];
    }

    public function headings(): array
    {
        return ['Destination URL','Short URL','Title','Code'];
    }
}

?>