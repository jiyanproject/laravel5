<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Employee;
use iteos\Models\EmployeeAttendance;
use iteos\Models\AttendanceTransaction;
use iteos\Models\EmployeeSalary;
use iteos\Models\AccountStatement;
use iteos\Models\JournalEntry;
use iteos\Models\CoaCategory;
use iteos\Models\ChartOfAccount;
use Carbon\Carbon;
use DB;
use Route;
use PDF;

class ReportsController extends Controller
{
    public function attendanceReport()
    {
    	return view('apps.pages.attendanceReport');
    }

    public function attendanceProcess(Request $request)
    {
    	$dates = $request->input('date_range');
        $dateRange = explode('-',$dates);
        $startDate = Carbon::parse($dateRange[0]);
        $endDate = Carbon::parse($dateRange[1]);
        $difference = $endDate->diff($startDate);
        $date_diff = $difference->format('%a');
        
        $data = DB::table('employees')
                    ->leftJoin('employee_attendances','employee_attendances.employee_id','employees.id')
                    ->leftJoin('employee_leaves','employee_leaves.employee_id','employees.id')
                    ->leftJoin('leave_transactions','leave_transactions.leave_id','employee_leaves.id')
                    ->where('employee_attendances.created_at','>=',$startDate)
                    ->where('employee_attendances.updated_at','<=',$endDate)
                    ->select(DB::raw('employees.employee_no as ID'),DB::raw('concat(employees.first_name," ",employees.last_name) as Name'),
                            DB::raw('sum(employee_attendances.working_hour) as Hours'),DB::raw('count(employee_attendances.id) as Present'),
                            DB::raw('count(leave_transactions.id) as Leaves'))
                    ->groupBy('employees.employee_no','employees.first_name','employees.last_name')
                    ->get();     
                                   
        return view('apps.reports.attendanceReport',compact('data','startDate','endDate','date_diff'));
    }

    public function attendanceDetail($id,$startDate,$endDate)
    {
        $id = Route::current()->parameter('ID');
        $start = Route::current()->parameter('startDate');
        $end = Route::current()->parameter('endDate');

        $employee = Employee::where('employee_no',$id)->first();
        $total = EmployeeAttendance::where('employee_id',$employee->id)
                                    ->where('created_at','>=',$start)
                                    ->where('updated_at','<=',$end)
                                    ->sum('working_hour');
        
        $data = DB::table('employees')
                    ->leftJoin('employee_attendances','employee_attendances.employee_id','employees.id')
                    ->leftJoin('attendance_transactions','attendance_transactions.attendance_id','employee_attendances.id')
                    ->where('employees.employee_no',$id)
                    ->where('employee_attendances.created_at','>=',$startDate)
                    ->where('employee_attendances.updated_at','<=',$endDate)
                    ->select('employees.id','employee_attendances.created_at','attendance_transactions.clock_in','attendance_transactions.clock_out','employee_attendances.working_hour','attendance_transactions.notes')
                    ->orderBy('employee_attendances.created_at','ASC')
                    ->get();

        return view('apps.reports.attendanceReportDetail',compact('data','employee','start','end','total'));
    }

    public function attendancePrint($id,$startDate,$endDate)
    {
        $id = Route::current()->parameter('ID');
        $start = Route::current()->parameter('startDate');
        $end = Route::current()->parameter('endDate');

        $employee = Employee::where('employee_no',$id)->first();
        $total = EmployeeAttendance::where('employee_id',$employee->id)
                                    ->where('created_at','>=',$start)
                                    ->where('updated_at','<=',$end)
                                    ->sum('working_hour');
        
        $data = DB::table('employees')
                    ->leftJoin('employee_attendances','employee_attendances.employee_id','employees.id')
                    ->leftJoin('attendance_transactions','attendance_transactions.attendance_id','employee_attendances.id')
                    ->where('employees.employee_no',$id)
                    ->where('employee_attendances.created_at','>=',$startDate)
                    ->where('employee_attendances.updated_at','<=',$endDate)
                    ->select('employees.id','employee_attendances.created_at','attendance_transactions.clock_in','attendance_transactions.clock_out','employee_attendances.working_hour','attendance_transactions.notes')
                    ->orderBy('employee_attendances.created_at','ASC')
                    ->get();

        return view('apps.reports.attendanceReportDetailPrint',compact('data','employee','start','end','total'));
    }

    public function attendancePdf($id,$startDate,$endDate)
    {
        $id = Route::current()->parameter('ID');
        $start = Route::current()->parameter('startDate');
        $end = Route::current()->parameter('endDate');

        $employee = Employee::where('employee_no',$id)->first();
        $total = EmployeeAttendance::where('employee_id',$employee->id)
                                    ->where('created_at','>=',$start)
                                    ->where('updated_at','<=',$end)
                                    ->sum('working_hour');
        $empName = ($employee->first_name).''.($employee->last_name);
        $data = DB::table('employees')
                    ->leftJoin('employee_attendances','employee_attendances.employee_id','employees.id')
                    ->leftJoin('attendance_transactions','attendance_transactions.attendance_id','employee_attendances.id')
                    ->where('employees.employee_no',$id)
                    ->where('employee_attendances.created_at','>=',$startDate)
                    ->where('employee_attendances.updated_at','<=',$endDate)
                    ->select('employees.id','employee_attendances.created_at','attendance_transactions.clock_in','attendance_transactions.clock_out','employee_attendances.working_hour','attendance_transactions.notes')
                    ->orderBy('employee_attendances.created_at','ASC')
                    ->get();

        $filename = $empName;
        
        $pdf = PDF::loadview('apps.reports.attendanceReportDetailPdf',compact('data','employee','start','end','total'));
        
        return $pdf->download(''.$filename.'.pdf');
    }

    public function financeReport()
    {
        $dates = EmployeeSalary::pluck('payroll_period','payroll_period')->map(function($date,$key) {
            return date('F Y',strtotime($date));
        })->toArray();
        
        return view('apps.pages.payrollReport',compact('dates'));
    }

    public function financeProcess()
    {
        
    }

    public function journalReportIndex()
    {
        return view('apps.pages.journalReport');
    }

    public function journalReportShow(Request $request)
    {
        $dateStart = $request->input('start');
        $dateEnd = $request->input('end');
        $data = AccountStatement::with('Child')->whereBetween('transaction_date',[$dateStart,$dateEnd])->orderBy('transaction_date','ASC')->get();
        /*$data = DB::table('account_statements')->join('bank_statements','bank_statements.trans_group','account_statements.trans_group')->where('account_statements.status_id','f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6')->get();*/
        /*$data = DB::table('account_statements')->where('status_id','f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6')->select('trans_group','transaction_date','account_id','bank_id','payee','amount','trans_type')->groupBy('trans_group','transaction_date','account_id','bank_id','payee','amount','trans_type')->get();*/
        
        return view('apps.reports.journalReport',compact('data','dateStart','dateEnd'));
    }

    public function trialBalanceIndex()
    {
        return view('apps.pages.trialBalance');
    }

    public function trialBalanceShow(Request $request)
    {
        $dateStart = $request->input('start');
        $dateEnd = $request->input('end');
        $data = ChartOfAccount::join('journal_entries','journal_entries.account_name','chart_of_accounts.id')
                                ->select(DB::raw('chart_of_accounts.account_id as ID, chart_of_accounts.account_name as Name, sum(journal_entries.amount) as Total, journal_entries.trans_type as Type'))
                                ->whereBetween('journal_entries.transaction_date',[$dateStart,$dateEnd])
                                ->orderBy('chart_of_accounts.account_id')
                                ->groupBy('chart_of_accounts.account_id','chart_of_accounts.account_name','journal_entries.trans_type')
                                ->get();
        $debit = DB::table('journal_entries')
                        ->where('trans_type','Debit')
                        ->where('transaction_date','>=',$dateStart)->where('transaction_date','<=',$dateEnd)
                        ->groupBy('trans_type')
                        ->sum('amount');
        $credit = DB::table('journal_entries')
                        ->where('trans_type','Credit')
                        ->where('transaction_date','>=',$dateStart)->where('transaction_date','<=',$dateEnd)
                        ->groupBy('trans_type')
                        ->sum('amount');
        /* $data = CoaCategory::join('chart_of_accounts','chart_of_accounts.account_category','coa_categories.id')
                             ->join('journal_entries','journal_entries.account_name','chart_of_accounts.id')
                             ->orderBy('coa_categories.id')
                             ->get(); */
       
        return view('apps.reports.trialBalance',compact('data','debit','credit','dateStart','dateEnd'));
    }

    public function generalLedgerIndex()
    {
        return view('apps.pages.generalLedger');
    }

    public function generalLedgerShow(Request $request)
    {
        $dateStart = $request->input('start');
        $dateEnd = $request->input('end');
        $data = ChartOfAccount::join('journal_entries','journal_entries.account_name','chart_of_accounts.id')
                                ->select(DB::raw('chart_of_accounts.account_id as ID, chart_of_accounts.account_name as Name, sum(chart_of_accounts.opening_balance) as Opening,sum(journal_entries.amount) as Total, 
                                journal_entries.trans_type as Type'))
                                ->whereBetween('journal_entries.transaction_date',[$dateStart,$dateEnd])
                                ->orderBy('chart_of_accounts.account_id')
                                ->groupBy('chart_of_accounts.account_id','chart_of_accounts.account_name','journal_entries.trans_type')
                                ->get();
        $debit = DB::table('journal_entries')
                        ->where('trans_type','Debit')
                        ->where('transaction_date','>=',$dateStart)->where('transaction_date','<=',$dateEnd)
                        ->groupBy('trans_type')
                        ->sum('amount');
        $credit = DB::table('journal_entries')
                        ->where('trans_type','Credit')
                        ->where('transaction_date','>=',$dateStart)->where('transaction_date','<=',$dateEnd)
                        ->groupBy('trans_type')
                        ->sum('amount');

        return view('apps.reports.generalLedger',compact('data','debit','credit','dateStart','dateEnd'));
    }


}
