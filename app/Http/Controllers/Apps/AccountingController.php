<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\BankAccount;
use iteos\Models\BankStatement;
use iteos\Models\ChartOfAccount;
use iteos\Models\CoaCategory;
use iteos\Models\AccountStatement;
use iteos\Models\JournalEntry;
use iteos\Models\AssetCategory;
use iteos\Models\AssetManagements;
use iteos\Models\AssetDepreciation;
use iteos\Models\DepreciationMethod;
use iteos\Models\BudgetPeriod;
use iteos\Models\BudgetDetail;
use iteos\Models\EmployeeSalary;
use Maatwebsite\Excel\Facades\Excel;
use iteos\Imports\BankTransactionImport;
use DB;
use Ramsey\Uuid\Uuid;
use Carbon\CarbonPeriod;

class AccountingController extends Controller
{
    public function index()
    {
        $salaries = EmployeeSalary::where('status_id','1f2967a5-9a88-4d44-a66b-5339c771aca0')->get();
        
    	return view('apps.pages.accountingHome');
    }

    public function bankIndex() 
    {
    	$banks = BankAccount::orderBy('bank_name','ASC')->get();
        $balances = BankStatement::latest('id')->first();
        $data = DB::table('bank_statements')->select('transaction_date','balance')->get();
        $array[] = ['transaction_date','balance'];
        foreach($data as $key=>$value) {
            $array[++$key] = [$value->transaction_date,(int)$value->balance];
        }

    	return view('apps.pages.bankStatementNew',compact('banks','balances'))->with('data',json_encode($array));
    }

    public function bankStatementIndex()
    {
        $data = BankStatement::orderBy('updated_at','DESC')->get();
        
        return view('apps.pages.statementIndex',compact('data'));
    }

    public function bankStatement()
    {
    	$bank = BankAccount::where('active','1')->pluck('bank_name','id')->toArray();

    	return view('apps.input.bankStatement',compact('bank'));
    }

    public function bankStatementImport(Request $request) 
    { 
    	$request->validate([
            'statement' => 'required|file|mimes:xlsx,xls,XLSX,XLS'
        ]);
 
        $input = $request->all();
        
        $data = Excel::toArray(new BankTransactionImport, $request->file('statement'))[0];
       
        foreach($data as $index=> $value) {
            if(isset($value['date'])) {
                $result = BankStatement::create([
                    'bank_account_id' => $request->input('bank_id'),
                    'transaction_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value['date']),
                    'payee' => $value['payee'],
                    'description' => $value['description'],
                    'type' => $value['type'],
                    'amount' => $value['amount'],
                    'balance' => $value['balance'],
                    'status_id' => 'e6cb9165-131e-406c-81c8-c2ba9a2c567e',
                ]);
            }
        }

        $log = 'Bank Statement Successfully Import';
        \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Bank Statement Successfully Import, Please reconcile with current account transaction',
            'alert-type' => 'success'
        );
        
        return redirect()->route('statToAcc.index')->with($notification);
    } 

    public function statementToAccount()
    {
        $data = BankStatement::where('status_id','e6cb9165-131e-406c-81c8-c2ba9a2c567e')->orderBy('created_at','ASC')->get();

        return view('apps.input.statementToAccount',compact('data'));
    }

    public function findTransactionByDate($id)
    {
        $filter = BankStatement::find($id);
        /* $data = AccountStatement::with('Child')
                                ->where('payee',$filter->payee)
                                ->where('transaction_date',$filter->transaction_date)
                                ->where('status_id','e6cb9165-131e-406c-81c8-c2ba9a2c567e')
                                ->first(); */
        $data = AccountStatement::with(['Child' => function($query) {
                                    $query->where('source','User');
                                }])
                                ->where('payee',$filter->payee)
                                ->orWhere('transaction_date',$filter->transaction_date)
                                ->where('status_id','e6cb9165-131e-406c-81c8-c2ba9a2c567e')
                                ->first();
        
        return view('apps.input.bankToAccountRev',compact('data','filter'));
        /* return view('apps.input.bankToAccount',compact('data','filter'))->renderSections()['content']; */
    }

    public function bankStatementMatch(Request $request,$id)
    {
        $data = BankStatement::where('id',$request->input('statement_id'))->first();
        $source = AccountStatement::with('Child')->where('id',$request->input('account_id'))->first();
        $changes = $data->update([
            'account_statement_id' => $source->id,
            'payee' => $source->payee,
            'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6'
        ]);
        
        $source->update([
            'statement_id' => $data->id,
            'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6'
        ]);
        /* $returnState = AccountStatement::with('Child')->where('id',$request->input('account_id'))->first();
        foreach($returnState->Child as $Child) {
            if(($data->type) == 'Receive') {
                $bankJournal = JournalEntry::create([
                    'account_statement_id' => $returnState->id,
                    'item' => $Child->item,
                    'description' => $Child->description,
                    'quantity' => $Child->quantity,
                    'unit_price' => $Child->unit_price,
                    'account_name' => $data->Banks->chart_id,
                    'trans_type' => 'Debit',
                    'amount' => ($Child->quantity)*($Child->unit_price),
                ]);
            } else {
                $bankJournal = JournalEntry::create([
                    'account_statement_id' => $returnState->id,
                    'item' => $Child->item,
                    'description' => $Child->description,
                    'quantity' => $Child->quantity,
                    'unit_price' => $Child->unit_price,
                    'account_name' => $data->Banks->chart_id,
                    'trans_type' => 'Credit',
                    'amount' => ($Child->quantity)*($Child->unit_price),
                ]);
            }
        } */
        
        
        /*$sources = AccountStatement::where('id',$request->input('account_id'))->first();
        if(($sources->trans_type) == 'Debit') {
            $entries = AccountStatement::create([
                'trans_group' => $sources->trans_group,
                'transaction_date' => $sources->transaction_date,
                'reference_no' => $sources->reference_no,
                'bank_id' => $data->bank_account_id,
                'payee' => $sources->payee,
                'item' => $sources->item,
                'description' => $sources->description,
                'amount' => $sources->amount,
                'trans_type' => 'Credit',
                'status_id' => $sources->status_id,
                'created_by' => auth()->user()->employee_id,
            ]);
        } else {
            $entries = AccountStatement::create([
                'trans_group' => $sources->trans_group,
                'transaction_date' => $sources->transaction_date,
                'reference_no' => $sources->reference_no,
                'bank_id' => $data->bank_account_id,
                'payee' => $sources->payee,
                'item' => $sources->item,
                'description' => $sources->description,
                'amount' => $sources->amount,
                'trans_type' => 'Debit',
                'status_id' => $sources->status_id,
                'created_by' => auth()->user()->employee_id,
            ]);
        }*/
        
        
        return redirect()->back();

    }

    public function accountIndex() 
    {
        $bank = BankAccount::first();
        $data = AccountStatement::with(['Child' => function($query) {
            $query->where('source','User');
        }])->orderBy('created_at','DESC')->paginate(10);
    	
    	return view('apps.pages.accountIndex',compact('data','bank'));
    }

    public function statementPeriod(Request $request)
    {
    	$data = AccountStatement::create([
    		'account_period' => $request->input('period'),
    		'created_by' => auth()->user()->employee_id,
    	]);

    	return redirect()->route('account.index');
    }

    public function AccountTransaction($id)
    {
        $bank = BankAccount::find($id);
    	$data  = AccountStatement::find($id);

    	return view('apps.pages.AccountTransaction',compact('data','bank'));
    }

    public function AccountTransactionShow($bank,$id)
    {
        $bank = BankAccount::where('id',$bank)->first();
        $data = AccountStatement::with(['Child' => function($query) {
            $query->where('source','User');
        }])->where('id',$id)->first();
        
        return view('apps.show.accountTransaction',compact('bank','data'));
    }

    public function AccountChecked(Request $request,$id)
    {
        $data = AccountStatement::find($id);
        $checked = $data->update([
            'status_id' => 'edcb2ad8-df07-4854-8260-383aaec4a061',
            'checked_by' => auth()->user()->employee_id,
        ]);

        return redirect()->back();
    }

    public function AccountApprove(Request $request,$id)
    {
        $data = AccountStatement::find($id);
        $approved = $data->update([
            'status_id' => 'ca52a2ce-5c37-48ce-a7f2-0fd5311860c2',
            'approved_by' => auth()->user()->employee_id,
        ]);

        return redirect()->back();
    }

    public function AccountPosted(Request $request,$id)
    {
        $data = AccountStatement::find($id);
        $posted = $data->update([
            'status_id' => 'dc664dfb-4895-4e4a-9517-b0446f0d9846',
            'posted_by' => auth()->user()->employee_id,
        ]);

        return redirect()->back();
    }

    public function AccountPrint($id)
    {
        $data = AccountStatement::with(['Child' => function($query) {
            $query->where('source','User');
        }])->where('id',$id)->first();
        
        return view('apps.print.accountTransaction',compact('data'));
    }

    public function AccountReconcile(Request $request,$id)
    {

    }

    public function spendCreate()
    {
        $bank = BankAccount::where('active','1')->pluck('bank_name','id')->toArray();
        $coas = ChartOfAccount::where('account_category','2')
                                ->orWhere('account_category','5')
                                ->orderBy('account_id','ASC')
                                ->pluck('account_name','id')
                                ->toArray();

    	return view('apps.input.transactionSpend',compact('coas','bank'));
    }

    public function spendStore(Request $request)
    {
        $bank = BankAccount::where('id',$request->input('bank'))->first();
        $prevData = AccountStatement::where('transaction_date','<=',$request->input('transaction_date'))->first();
        if(!empty($prevData)) {
            $savePrev = $prevData->balance;
        } else {
            $savePrev = '0';
        }

        $dataM = AccountStatement::create([
            'transaction_date' => $request->input('transaction_date'),
            'reference_no' => $request->input('reference_no'),
            'payee' => $request->input('payee'),
            'tax_reference' => $request->input('tax_reference'),
            'status_id' => '1f2967a5-9a88-4d44-a66b-5339c771aca0',
            'created_by' => auth()->user()->employee_id,
        ]);
        
        $items = $request->item;
        $descriptions = $request->description;
        $quantities = $request->quantity;
        $prices = $request->unit_price;
        $accounts = $request->account;
        $taxes = $request->tax;
        $files = $request->file;
        $total = 0;
        
        foreach($items as $index=>$item) {
            if($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                $path = $uploadedFile->store('transaction_receive');
                if(empty($taxes[$index])) {
                    $dataE = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $accounts[$index],
                        'trans_type' => 'Debit',
                        'file' => $path,
                        'amount' => ($quantities[$index])*($prices[$index]),
                    ]);
                    $dataB = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $bank->chart_id,
                        'trans_type' => 'Credit',
                        'file' => $path,
                        'amount' => ($quantities[$index])*($prices[$index]),
                        'source' => 'Bank',
                    ]);
                } else {
                    $dataE = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $accounts[$index],
                        'trans_type' => 'Debit',
                        'tax_rate' => $taxes[$index],
                        'tax_amount' => ($quantities[$index]*$prices[$index])*$taxes[$index]/100,
                        'file' => $path,
                        'amount' => (($quantities[$index])*($prices[$index]))+((($quantities[$index])*($prices[$index]))*($taxes[$index])/100),
                    ]);
                    $dataB = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $bank->chart_id,
                        'trans_type' => 'Credit',
                        'tax_rate' => $taxes[$index],
                        'tax_amount' => ($quantities[$index]*$prices[$index])*$taxes[$index]/100,
                        'file' => $path,
                        'amount' => (($quantities[$index])*($prices[$index]))+((($quantities[$index])*($prices[$index]))*($taxes[$index])/100),
                        'source' => 'Bank',
                    ]);
                }
                
            } else {
                if(empty($taxes[$index])) {
                    $dataE = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $accounts[$index],
                        'trans_type' => 'Debit',
                        'amount' => ($quantities[$index])*($prices[$index]),
                    ]);
                    $dataB = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $bank->chart_id,
                        'trans_type' => 'Credit',
                        'amount' => ($quantities[$index])*($prices[$index]),
                        'source' => 'Bank',
                    ]);
                } else {
                    $dataE = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $accounts[$index],
                        'trans_type' => 'Debit',
                        'tax_rate' => $taxes[$index],
                        'tax_amount' => ($quantities[$index]*$prices[$index])*$taxes[$index]/100,
                        'amount' => (($quantities[$index])*($prices[$index]))+((($quantities[$index])*($prices[$index]))*($taxes[$index])/100),
                    ]);
                    $dataB = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $bank->chart_id,
                        'trans_type' => 'Credit',
                        'tax_rate' => $taxes[$index],
                        'tax_amount' => ($quantities[$index]*$prices[$index])*$taxes[$index]/100,
                        'amount' => (($quantities[$index])*($prices[$index]))+((($quantities[$index])*($prices[$index]))*($taxes[$index])/100),
                        'source' => 'Bank',
                    ]);
                }
            }
            $total+=$dataE->amount;
        }

        $sum = AccountStatement::where('id',$dataM->id)->first();
        $updateSum = $sum->update([
            'balance' => ($savePrev) - ($total),
            'total' => $total,
        ]);

        return redirect()->route('accountTransaction.index',$bank->id);
    }

    public function receiveCreate()
    {
        $bank = BankAccount::where('active','1')->pluck('bank_name','id')->toArray();
        $coas = ChartOfAccount::where('account_category','4')
                                ->orderBy('account_id','ASC')
                                ->pluck('account_name','id')
                                ->toArray();

        return view('apps.input.transactionReceive',compact('bank','coas'));
    }

    public function receiveStore(Request $request)
    {
        $bank = BankAccount::where('id',$request->input('bank'))->first();
        $prevData = AccountStatement::where('transaction_date','<=',$request->input('transaction_date'))->first();

        if(!empty($prevData)) {
            $savePrev = $prevData->balance;
        } else {
            $savePrev = '0';
        }
        
        $dataM = AccountStatement::create([
            'transaction_date' => $request->input('transaction_date'),
            'reference_no' => $request->input('reference_no'),
            'payee' => $request->input('payee'),
            'tax_reference' => $request->input('tax_reference'),
            'status_id' => '1f2967a5-9a88-4d44-a66b-5339c771aca0',
            'created_by' => auth()->user()->employee_id,
        ]);
        
        $items = $request->item;
        $descriptions = $request->description;
        $quantities = $request->quantity;
        $prices = $request->unit_price;
        $accounts = $request->account;
        $taxes = $request->tax;
        $files = $request->file;
        $total = 0;

        foreach($items as $index=>$item) {
            if($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                $path = $uploadedFile->store('transaction_receive');
                if(empty($taxes[$index])) {
                    $dataE = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $accounts[$index],
                        'trans_type' => 'Credit',
                        'file' => $path,
                        'amount' => ($quantities[$index])*($prices[$index]),
                    ]);
                    $dataB = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $bank->chart_id,
                        'trans_type' => 'Debit',
                        'file' => $path,
                        'amount' => ($quantities[$index])*($prices[$index]),
                        'source' => 'Bank',
                    ]);
                } else {
                    $dataE = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $bank->chart_id,
                        'account_name' => $accounts[$index],
                        'trans_type' => 'Credit',
                        'file' => $path,
                        'amount' => ($quantities[$index])*($prices[$index]),
                    ]);
                    $dataB = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $bank->chart_id,
                        'trans_type' => 'Debit',
                        'file' => $path,
                        'amount' => ($quantities[$index])*($prices[$index]),
                        'source' => 'Bank',
                    ]);
                }
                
            } else {
                if(empty($taxes[$index])) {
                    $dataE = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $accounts[$index],
                        'trans_type' => 'Credit',
                        'amount' => ($quantities[$index])*($prices[$index]),
                    ]);
                    $dataB = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $bank->chart_id,
                        'trans_type' => 'Debit',
                        'amount' => ($quantities[$index])*($prices[$index]),
                        'source' => 'Bank',
                    ]);
                } else {
                    $dataE = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $accounts[$index],
                        'trans_type' => 'Credit',
                        'tax_rate' => $taxes[$index],
                        'amount' => ($quantities[$index])*($prices[$index]),
                    ]);
                    $dataB = JournalEntry::create([
                        'account_statement_id' => $dataM->id,
                        'transaction_date' => $dataM->transaction_date,
                        'item' => $item,
                        'description' => $descriptions[$index],
                        'quantity' => $quantities[$index],
                        'unit_price' => $prices[$index],
                        'account_name' => $bank->chart_id,
                        'trans_type' => 'Debit',
                        'tax_rate' => $taxes[$index],
                        'amount' => ($quantities[$index])*($prices[$index]),
                        'source' => 'Bank',
                    ]);
                }
            }
            $total+=$dataE->amount;
        }

        $sum = AccountStatement::where('id',$dataM->id)->first();

        $updateSum = $sum->update([
            'balance' => ($savePrev) + ($total),
            'total' => $total,
        ]);

        return redirect()->route('accountTransaction.index',$bank->id);
    }

    public function transactionEdit($id)
    {
        $data = AccountStatement::find($id);
        $detail = JournalEntry::where('account_statement_id',$data->id)->where('source','User')->get();
        $coas = ChartOfAccount::pluck('account_name','id')->toArray();
        $bank = BankAccount::where('active','1')->pluck('bank_name','id')->toArray();

        return view('apps.edit.accountTransaction',compact('data','detail','coas','bank'));
    } 

    public function transactionUpdate(Request $request,$id)
    {
        $bank = BankAccount::where('id',$request->input('bank'))->first();
        $prevData = AccountStatement::where('transaction_date','<=',$request->input('transaction_date'))->where('id','!=',$id)->first();
        
        if(!empty($prevData)) {
            $savePrev = $prevData->balance;
        } else {
            $savePrev = '0';
        }

        $data = AccountStatement::find($id);
        $dataM = $data->update([
            'transaction_date' => $request->input('transaction_date'),
            'reference_no' => $request->input('reference_no'),
            'payee' => $request->input('payee'),
            'tax_reference' => $request->input('tax_reference'),
            'status_id' => '1f2967a5-9a88-4d44-a66b-5339c771aca0',
            'updated_by' => auth()->user()->employee_id,
        ]);

        $entries = JournalEntry::where('account_statement_id',$id)->delete();
        
        $items = $request->item;
        $descriptions = $request->description;
        $quantities = $request->quantity;
        $prices = $request->unit_price;
        $accounts = $request->account;
        $taxes = $request->tax;
        $files = $request->file;
        $types = $request->trans_type;
        $total = 0;
        
        
        foreach($items as $index=>$item) {
            if(($types[$index]) == 'Credit') {
                if($request->hasFile('file')) {
                    $uploadedFile = $request->file('file');
                    $path = $uploadedFile->store('transaction_receive');
                    if(empty($taxes[$index])) {
                        $dataE = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $accounts[$index],
                            'trans_type' => 'Credit',
                            'file' => $path,
                            'amount' => ($quantities[$index])*($prices[$index]),
                        ]);
                        $dataB = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $bank->chart_id,
                            'trans_type' => 'Debit',
                            'file' => $path,
                            'amount' => ($quantities[$index])*($prices[$index]),
                            'source' => 'Bank',
                        ]);
                    } else {
                        $dataE = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $bank->chart_id,
                            'account_name' => $accounts[$index],
                            'trans_type' => 'Credit',
                            'file' => $path,
                            'amount' => ($quantities[$index])*($prices[$index]),
                        ]);
                        $dataB = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $bank->chart_id,
                            'trans_type' => 'Debit',
                            'file' => $path,
                            'amount' => ($quantities[$index])*($prices[$index]),
                            'source' => 'Bank',
                        ]);
                    }
                    
                } else {
                    if(empty($taxes[$index])) {
                        $dataE = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $accounts[$index],
                            'trans_type' => 'Credit',
                            'amount' => ($quantities[$index])*($prices[$index]),
                        ]);
                        $dataB = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $bank->chart_id,
                            'trans_type' => 'Debit',
                            'amount' => ($quantities[$index])*($prices[$index]),
                            'source' => 'Bank',
                        ]);
                    } else {
                        $dataE = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $accounts[$index],
                            'trans_type' => 'Credit',
                            'tax_rate' => $taxes[$index],
                            'amount' => ($quantities[$index])*($prices[$index]),
                        ]);
                        $dataB = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $bank->chart_id,
                            'trans_type' => 'Debit',
                            'tax_rate' => $taxes[$index],
                            'amount' => ($quantities[$index])*($prices[$index]),
                            'source' => 'Bank',
                        ]);
                    }
                }
                $total+=$dataE->amount;

                $sum = AccountStatement::where('id',$data->id)->first();

                $updateSum = $sum->update([
                    'balance' => ($savePrev) + ($total),
                    'total' => $total,
                ]);
            } else {
                if($request->hasFile('file')) {
                    $uploadedFile = $request->file('file');
                    $path = $uploadedFile->store('transaction_receive');
                    if(empty($taxes[$index])) {
                        $dataE = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $accounts[$index],
                            'trans_type' => 'Debit',
                            'file' => $path,
                            'amount' => ($quantities[$index])*($prices[$index]),
                        ]);
                        $dataB = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $bank->chart_id,
                            'trans_type' => 'Credit',
                            'file' => $path,
                            'amount' => ($quantities[$index])*($prices[$index]),
                            'source' => 'Bank',
                        ]);
                    } else {
                        $dataE = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $accounts[$index],
                            'trans_type' => 'Debit',
                            'tax_rate' => $taxes[$index],
                            'tax_amount' => ($quantities[$index]*$prices[$index])*$taxes[$index]/100,
                            'file' => $path,
                            'amount' => (($quantities[$index])*($prices[$index]))+((($quantities[$index])*($prices[$index]))*($taxes[$index])/100),
                        ]);
                        $dataB = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $bank->chart_id,
                            'trans_type' => 'Credit',
                            'tax_rate' => $taxes[$index],
                            'tax_amount' => ($quantities[$index]*$prices[$index])*$taxes[$index]/100,
                            'file' => $path,
                            'amount' => (($quantities[$index])*($prices[$index]))+((($quantities[$index])*($prices[$index]))*($taxes[$index])/100),
                            'source' => 'Bank',
                        ]);
                    }
                    
                } else {
                    if(empty($taxes[$index])) {
                        $dataE = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $accounts[$index],
                            'trans_type' => 'Debit',
                            'amount' => ($quantities[$index])*($prices[$index]),
                        ]);
                        $dataB = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $bank->chart_id,
                            'trans_type' => 'Credit',
                            'amount' => ($quantities[$index])*($prices[$index]),
                            'source' => 'Bank',
                        ]);
                    } else {
                        $dataE = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $accounts[$index],
                            'trans_type' => 'Debit',
                            'tax_rate' => $taxes[$index],
                            'tax_amount' => ($quantities[$index]*$prices[$index])*$taxes[$index]/100,
                            'amount' => (($quantities[$index])*($prices[$index]))+((($quantities[$index])*($prices[$index]))*($taxes[$index])/100),
                        ]);
                        $dataB = JournalEntry::create([
                            'account_statement_id' => $data->id,
                            'transaction_date' => $data->transaction_date,
                            'item' => $item,
                            'description' => $descriptions[$index],
                            'quantity' => $quantities[$index],
                            'unit_price' => $prices[$index],
                            'account_name' => $bank->chart_id,
                            'trans_type' => 'Credit',
                            'tax_rate' => $taxes[$index],
                            'tax_amount' => ($quantities[$index]*$prices[$index])*$taxes[$index]/100,
                            'amount' => (($quantities[$index])*($prices[$index]))+((($quantities[$index])*($prices[$index]))*($taxes[$index])/100),
                            'source' => 'Bank',
                        ]);
                    }
                }
                $total+=$dataE->amount;

                $sum = AccountStatement::where('id',$data->id)->first();

                $updateSum = $sum->update([
                    'balance' => ($savePrev) - ($total),
                    'total' => $total,
                ]);
            }
            
        }
        return redirect()->route('accountTransaction.index',$bank->id);

    }

    public function assetManagementIndex()
    { 
        $data = AssetManagements::orderBy('name','ASC')->get();
        $categories = AssetCategory::orderBy('category_name','ASC')->pluck('category_name','id')->toArray();
        $depreciations = DepreciationMethod::orderBy('id','ASC')->pluck('name','id')->toArray();
        return view('apps.pages.assetManagement',compact('data','categories','depreciations'));
    }

    public function assetManagementStore(Request $request)
    {
        $this->validate($request, [
            'asset_code' => 'required',
            'asset_name' => 'required',
            'category_name' => 'required',
            'purchase_date' => 'required',
            'purchase_price' => 'required',
            'purchase_from' => 'required',
            'estimate_time' => 'required',
            'residual_value' => 'required',
        ]);

        $data = AssetManagements::create([
            'asset_code' => $request->input('asset_code'),
            'name' => $request->input('asset_name'),
            'category_name' => $request->input('category_name'),
            'purchase_date' => $request->input('purchase_date'),
            'warranty_expire' => $request->input('warranty_expire'),
            'purchase_price' => $request->input('purchase_price'),
            'purchase_from' => $request->input('purchase_from'),
            'estimate_time' => $request->input('estimate_time'),
            'residual_value' => $request->input('residual_value'),
            'method_id' => $request->input('method_id'),
            'status_id' => '49e185eb-bba9-4ef2-bb9e-dbbd650a10cc',
        ]);

        $log = 'Asset'.($data->name).' Created';
        \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset'.($data->name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('asset.index')->with($notification);
    }

    public function assetManagementShow($id)
    {
        $data = AssetManagements::find($id);
        $details = AssetDepreciation::where('asset_id',$id)->orderBy('created_at','ASC')->get();

        return view('apps.show.assetDepreciation',compact('data','details'));
    }

    public function assetManagementDelete($id)
    {
        $data = AssetManagement::find($id);
        $data->update([
            'status_id' => '',
        ]);

        return redirect()->route('asset.index');
    }

    public function budgetManagerIndex()
    {
        $data = BudgetPeriod::orderBy('updated_at','DESC')->get();

        return view('apps.pages.budgetManager',compact('data'));
    }

    public function budgetNewStore(Request $request)
    {
        $this->validate($request, [
            'budget_title' => 'required',
            'budget_start' => 'required',
            'budget_end' => 'required',
        ]);

        $data = BudgetPeriod::create([
            'budget_title' => $request->input('budget_title'),
            'budget_start' => $request->input('budget_start'),
            'budget_end' => $request->input('budget_end'),
            'status_id' => '1f2967a5-9a88-4d44-a66b-5339c771aca0',
            'created_by' => auth()->user()->employee_id,
        ]);

        return redirect()->route('budgetDetail.create',$data->id);
    }

    public function budgetDetailCreate($id)
    {
        $parent = BudgetPeriod::find($id);
        $accounts = CoaCategory::with('Child')->where('category_name','Revenue')->orWhere('category_name','Expense')->orderBy('id')->get();
        $budgetRange = CarbonPeriod::create($parent->budget_start,'1 month',$parent->budget_end);
        
        return view('apps.input.budgetDetail',compact('parent','accounts','budgetRange'));

    }

    public function budgetOptionStore(Request $request)
    {

    }

    public function budgetDetailStore(Request $request)
    {
        $parent = BudgetPeriod::where('id',$request->input('budget_id'))->first();
        $input = $request->all();

        $accounts = $request->account_name;
        $categories = $request->account_category;
        $periods = $request->budget_period;
        $amounts = $request->amount;
        foreach($accounts as $index=>$account) {
            $data = BudgetDetail::create([
                'budget_id' => $parent->id,
                'account_name' => $account,
                'account_category' => $categories[$index],
                'budget_period' => $periods[$index],
                'budget_amount' => $amounts[$index],
            ]);
        }

        return redirect()->route('budget.index');
    }

    public function budgetApproval(Request $request,$id)
    {
        $data = BudgetPeriod::find($id);
        $data->update([
            'status_id' => 'ca52a2ce-5c37-48ce-a7f2-0fd5311860c2',
            'updated_by' => auth()->user()->employee_id,
            'approved_by' => auth()->user()->employee_id
        ]);

        return redirect()->route('budget.index');
    }

    public function budgetDetailEdit($id)
    {
        $parent = BudgetPeriod::find($id);
        $incomes = BudgetDetail::where('budget_id',$parent->id)->where('account_category','4')->get();
        $expenses = BudgetDetail::where('budget_id',$parent->id)->where('account_category','5')->get();
        $accounts = CoaCategory::with('Child')->where('category_name','Revenue')->orWhere('category_name','Expense')->orderBy('id')->get();
        $budgetRange = CarbonPeriod::create($parent->budget_start,'1 month',$parent->budget_end);
        $groupedIncome = $incomes->groupBy('account_name')->toArray();
        $groupedExpense = $expenses->groupBy('account_name')->toArray();
        
        return view('apps.edit.budgetDetail',compact('parent','groupedIncome','groupedExpense','expenses','accounts','budgetRange'));
    }

    public function budgetDetailUpdate(Request $request,$id)
    {
        $input = $request->all();
       

        $parent = BudgetPeriod::where('id',$request->input('budget_id'))->first();
        $input = $request->all();

        $accounts = $request->account_name;
        $categories = $request->account_category;
        $periods = $request->budget_period;
        $amounts = $request->amount;
        
        foreach($amounts as $index=>$amount) {
            $data = BudgetDetail::where('budget_id',$parent->id)->where('account_name',$accounts[$index])->update([
                'budget_amount' => $amount,
            ]);
        }

        return redirect()->route('budget.index');
    }

    public function journalIndex()
    {
        return view('apps.pages.manualJournal');
    }

    public function journalCreate()
    {
        $coas = ChartOfAccount::orderBy('account_id')->pluck('account_name','id')->toArray();

        return view('apps.input.manualJournal',compact('coas'));
    }

    public function journalStore(Request $request)
    {
        $prevData = AccountStatement::where('transaction_date','<=',$request->input('transaction_date'))->first();
        if(!empty($prevData)) {
            $savePrev = $prevData->balance;
        } else {
            $savePrev = '0';
        }

        $statements = AccountStatement::create([
            'transaction_date' => $request->input('transaction_date'),
            'reference_no' => $request->input('reference'),
            'payee' => $request->input('payee'),
            'tax_reference' => $request->input('tax_reference'),
            'status_id' => '1f2967a5-9a88-4d44-a66b-5339c771aca0',
            'created_by' => auth()->user()->employee_id,
        ]);

        $items = $request->item;
        $debits = $request->debit;
        $credits = $request->credit;
        $debaccounts = $request->debit_account;
        $creaccounts = $request->credit_account;
        $total = 0;

        foreach($items as $index=>$item) {
            $debit = JournalEntry::create([
                'account_statement_id' => $statements->id,
                'item' => $item,
                'unit_price' => $debits[$index],
                'account_name' => $debaccounts[$index],
                'trans_type' => 'Debit',
                'amount' => $debits[$index],
            ]);
            $credit = JournalEntry::create([
                'account_statement_id' => $statements->id,
                'item' => $item,
                'unit_price' => $credits[$index],
                'account_name' => $creaccounts[$index],
                'trans_type' => 'Credit',
                'amount' => $credits[$index],
            ]);
        }
        $total+=$debit->amount;

        $sum = AccountStatement::where('id',$statements->id)->first();
        $updateSum = $sum->update([
            'balance' => ($savePrev) - ($total),
            'total' => $total,
        ]);

        $log = 'Manual Journal Created';
        \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Manual Journal Created',
            'alert-type' => 'success'
        );
        
        return redirect()->route('manualJournal.index')->with($notification);

    }

}
