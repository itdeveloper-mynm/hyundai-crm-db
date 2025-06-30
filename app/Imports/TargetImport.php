<?php

namespace App\Imports;

use App\Models\Target;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithValidation;

class TargetImport implements ToModel , WithHeadingRow, WithValidation
{
    use Importable;

    public function rules(): array
    {
        return [
            'date' => 'required',
            'count'  => 'required',
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return Target::updateOrCreate(
            ['date' => $row['date']],  // Find by date
            ['count' => $row['count']] // Update or create with this count
        );

    }
}
