<?php

namespace App\Imports;

use App\Models\Todo;
use Maatwebsite\Excel\Concerns\ToModel;

class TodosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Todo([
            'task'    => $row[0], 
            'status'    => $row[1], 
        ]);
    }
}
