<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\GoogleBusiness;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GoogleBusinessImport implements ToModel, WithHeadingRow
{

    use Importable;
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new GoogleBusiness([
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'gtype' => request('gtype'),
            'month' => request('month'),
            'year' => request('year'),
            'greviews' => $row['greviews'] ?? 0,
            'greplied' => $row['greplied'] ?? 0,
            'gsearchlisting' => $row['gsearchlisting'] ?? 0,
            'gmapslisting' => $row['gmapslisting'] ?? 0,
            'gwebsite' => $row['gwebsite'] ?? 0,
            'gdirection' => $row['gdirection'] ?? 0,
            'gcalls' => $row['gcalls'] ?? 0,
        ]);
    }
}
