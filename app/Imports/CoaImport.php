<?php

namespace iteos\Imports;

use iteos\ChartOfAccount;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class CoaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ChartOfAccount([
            'account_id' => $row['account_id'],
            'account_name' => $row['account_name'],
            'account_category' => $row['account_category'],
            'opening_balance' => $row['opening_balance'],
            'created_by' => auth()->user()->employee_id
        ]);
    }
}
