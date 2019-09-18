<?php

namespace App;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Exports implements FromCollection, WithHeadings
{
	protected $invoices;

    public function __construct(array $export)
    {
        $this->export = $export;
    }


    public function collection()
    {
        //return User::all();
        return collect($this->export);
    }

    public function headings(): array
    {
        return [
            'Application Id',
            'Name',
            'Email',
            'Subject',
            'Leave Days',
            'Status',
            'Created At',
            'Responce',
            'Responce At',
        ];
    }
}
