<?php

namespace App\Imports;

use App\Overtime;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportOvertime implements ToModel,WithProgressBar,WithHeadingRow,WithValidation
{
    use Importable;
    /**
     * @param array $row
     *
     * @return Overtime|null
     */
    public function model(array $row)
    {
        $user = User::where('full_name',$row['username'])->get('id');
        foreach ($user as $us) {
            $id = $us->id;
        }
        $date_type = $row['type_date'];
        if ($date_type == 'weekday') {
            $type = 1;
        } elseif ($date_type == 'weekend') {
            $type = 1.5;
        } else {
            $type = 2;
        }
        return new Overtime([
            'user_id' => $id,
            'date' => $row['date'],
            'date_type' => $type,
            'time_start' => $row['start_time'],
            'time_end' => $row['end_time'],
            'work' => $row['work'],
            'over_time' => $row['overtime']
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
    public function rules(): array
    {
        return [
            'username' => 'required',
            'date' => 'required',
            'type_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'work' => 'required',
            'overtime' => 'required'
        ];
    }
    public function customValidationMessages()
    {
        return [
            'required' => 'The ::attribute field is required.'
        ];
    }
}
