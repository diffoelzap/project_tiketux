<?php

namespace App\Exports;

use App\Models\CheckEmail;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmailExport implements FromCollection,WithHeadings
{
    protected $status;

    public function __construct($id_transaction)
    {
        $this->id_transaction = $id_transaction;
    }

    public function collection()
    {
        return CheckEmail::select( 'id',
        'email',
        DB::raw('CASE
                   WHEN validation IS NULL THEN "belum di validasi"
                   WHEN validation IS NOT NULL THEN validation
                   ELSE "unknown"
                 END AS validation_check'),
        'created_at')->where('id_transaction', $this->id_transaction)->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Email',
            'Validation',
            'Created At',
            'Updated At'
        ];
    }
}
