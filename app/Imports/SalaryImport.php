<?php

namespace iteos\Imports;

use iteos\Models\EmployeeSalary;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;
use Carbon\Carbon;

class SalaryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmployeeSalary([
            'payroll_period' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['period']),
            'employee_no' => $row['id'],
            'employee_name' => $row['name'],
            'nett_salary' => $row['nett_salary'],
            'jkk' => $row['jkk'],
            'jkm' => $row['jkm'],
            'leave_balance' => $row['leave_balance'],
            'rewards' => $row['annual_rewards'],
            'expense' => $row['occational_expense'],
            'bpjs_c' => $row['pay_bpjs_c'],
            'bpjs_e' => $row['pay_bpjs_e'],
            'jht_c' => $row['pay_jht_c'],
            'jht_e' => $row['pay_jht_e'],
            'jp_c' => $row['pay_jp_c'],
            'jp_e' => $row['pay_jp_e'],
            'dplk' => $row['pay_dplk'],
            'income_tax' => $row['tax_month'],
            'receive_payroll' => $row['thp'],
            'created_by' => auth()->user()->employee_id,
        ]);
    }
}
