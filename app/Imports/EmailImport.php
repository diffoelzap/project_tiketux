<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use sorciulus\EmailChecker\EmailChecker;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use sorciulus\EmailChecker\Exception\EmailCheckerException;

class EmailImport implements ToCollection,WithHeadingRow
{
    protected $emails = [];


    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->emails[] = $row['email']; // Mengambil data dari kolom email (kolom pertama)
        }
    }

    public function getEmails()
    {
        return $this->emails;
    } 
    
}
