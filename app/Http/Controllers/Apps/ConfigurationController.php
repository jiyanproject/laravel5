<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\User;
use iteos\Models\EmployeePosition;
use iteos\Models\LeaveType;
use iteos\Models\ReimbursType;
use iteos\Models\DocumentCategory;
use iteos\Models\GrievanceCategory;
use iteos\Models\ChartOfAccount;
use iteos\Models\CoaCategory;
use iteos\Models\AssetCategory;
use iteos\Models\BankAccount;
use iteos\Models\BankStatement;
use iteos\Models\AccountStatement;
use iteos\Models\Organization;
use iteos\Models\Office;
use iteos\Models\Province;
use iteos\Models\City;
use iteos\Models\Holiday;
use iteos\Models\Division;
use iteos\Imports\CoaImport;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;
use DB;
use Auth;

class ConfigurationController extends Controller
{
    public function index()
    {
    	return view('apps.pages.configurationPage');
    }

    public function applicationIndex()
    {
    	return view('apps.pages.applicationSetting');
    }

    public function positionIndex()
    {
        $data = EmployeePosition::orderBy('id','ASC')->get();

    	return view('apps.pages.employeePosition',compact('data'));
    }

    public function positionStore(Request $request)
    {
        $this->validate($request, [
            'position_name' => 'required',
        ]);

        $data = EmployeePosition::create([
            'position_name' => $request->input('position_name'),
            'created_by' => auth()->user()->id,
        ]);

        $log = 'Position '.($data->position_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Position '.($data->position_name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('position.index')->with($notification);
    }

    public function positionEdit($id)
    {
        $data = EmployeePosition::find($id);

        return view('apps.edit.employeePosition',compact('data'))->renderSections()['content'];
    }

    public function positionUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'position_name' => 'required',
        ]);
        $orig = EmployeePosition::find($id);
        $data = $orig->update([
            'position_name' => $request->input('position_name'),
            'updated_by' => auth()->user()->id,
        ]);

        $log = 'Position '.($orig->position_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Position '.($orig->position_name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('position.index')->with($notification);
    }

    public function positionDestroy($id)
    {
        $data = EmployeePosition::find($id);
        $log = 'Position '.($data->position_name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Position '.($data->position_name).' Deleted',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('position.index')->with($notification);
    }

    public function divisionIndex()
    {
        $data = Division::orderBy('id','ASC')->get();

    	return view('apps.pages.division',compact('data'));
    }

    public function divisionStore(Request $request)
    {
        $this->validate($request, [
            'division_name' => 'required',
        ]);

        $data = Division::create([
            'division_name' => $request->input('division_name'),
        ]);

        $log = 'Division '.($data->division_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Division '.($data->division_name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('division.index')->with($notification);
    }

    public function divisionEdit($id)
    {
        $data = Division::find($id);

        return view('apps.edit.division',compact('data'))->renderSections()['content'];
    }

    public function divisionUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'division_name' => 'required',
        ]);
        $orig = Division::find($id);
        $data = $orig->update([
            'division_name' => $request->input('division_name'),
        ]);

        $log = 'Division '.($orig->division_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Division '.($orig->position_name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('division.index')->with($notification);
    }

    public function leaveTypeIndex()
    {
        $data = LeaveType::orderBy('id','ASC')->get();
        $firsts = User::pluck('name','employee_id')->toArray();
        $seconds = User::pluck('name','employee_id')->toArray();

    	return view('apps.pages.leaveType',compact('data','firsts','seconds'));
    }

    public function leaveTypeStore(Request $request)
    {
        $this->validate($request, [
            'leave_name' => 'required',
            'first_approval' => 'required',
        ]);

        $data = LeaveType::create([
            'leave_name' => $request->input('leave_name'),
            'first_approval' => $request->input('first_approval'),
            'second_approval' => $request->input('second_approval'),
            'created_by' => auth()->user()->employee_id,
        ]);

        $log = ''.($data->leave_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => ''.($data->leave_name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('leaveType.index')->with($notification);
    }

    public function leaveTypeEdit($id)
    {
        $data = LeaveType::find($id);
        $firsts = User::pluck('name','employee_id')->toArray();
        $seconds = User::pluck('name','employee_id')->toArray();

        return view('apps.edit.leaveType',compact('data','firsts','seconds'))->renderSections()['content'];
    }

    public function leaveTypeUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'leave_name' => 'required',
            'first_approval' => 'required',
            'second_approval' => 'required',
        ]);
        $orig = LeaveType::find($id);
        $data = $orig->update([
            'leave_name' => $request->input('leave_name'),
            'first_approval' => $request->input('first_approval'),
            'second_approval' => $request->input('second_approval'),
            'updated_by' => auth()->user()->employee_id,
        ]);

        $log = ''.($orig->leave_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => ''.($orig->leave_name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('leaveType.index')->with($notification);
    }

    public function leaveTypeDestroy($id)
    {
        $data = LeaveType::find($id);
        $log = 'Type '.($data->leave_name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Type '.($data->leave_name).' Deleted',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('leaveType.index')->with($notification);
    }

    public function reimbursTypeIndex()
    {
        $data = ReimbursType::orderBy('id','ASC')->get();

    	return view('apps.pages.reimbursType',compact('data'));
    }

    public function reimbursTypeStore(Request $request)
    {
        $this->validate($request, [
            'reimburs_name' => 'required',
        ]);

        $data = ReimbursType::create([
            'reimburs_name' => $request->input('reimburs_name'),
            'created_by' => auth()->user()->id,
        ]);

        $log = 'Type '.($data->reimburs_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Type '.($data->reimburs_name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('reimbursType.index')->with($notification);
    }

    public function reimbursTypeEdit($id)
    {
        $data = ReimbursType::find($id);

        return view('apps.edit.reimbursType',compact('data'))->renderSections()['content'];
    }

    public function reimbursTypeUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'reimburs_name' => 'required',
        ]);
        $orig = ReimbursType::find($id);
        $data = $orig->update([
            'reimburs_name' => $request->input('reimburs_name'),
            'updated_by' => auth()->user()->id,
        ]);

        $log = 'Type '.($orig->reimburs_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Type '.($orig->reimburs_name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('reimbursType.index')->with($notification);
    }

    public function reimbursTypeDestroy($id)
    {
        $data = ReimbursType::find($id);
        $log = 'Type '.($data->reimburs_name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Type '.($data->reimburs_name).' Deleted',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('reimbursType.index')->with($notification);
    }

    public function documentCategoryIndex()
    {
        $data = DocumentCategory::orderBy('id','ASC')->get();

    	return view('apps.pages.documentCategory',compact('data'));
    }

    public function documentCategoryStore(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
        ]);

        $data = DocumentCategory::create([
            'category_name' => $request->input('category_name'),
            'created_by' => auth()->user()->id,
        ]);

        $log = 'Category '.($data->category_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Category '.($data->category_name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('docCat.index')->with($notification);
    }

    public function documentCategoryEdit($id)
    {
        $data = DocumentCategory::find($id);

        return view('apps.edit.documentCategory',compact('data'))->renderSections()['content'];
    }

    public function documentCategoryUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'category_name' => 'required',
        ]);
        $orig = DocumentCategory::find($id);
        $data = $orig->update([
            'category_name' => $request->input('category_name'),
            'updated_by' => auth()->user()->id,
        ]);

        $log = 'Category '.($orig->category_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Category '.($orig->category_name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('docCat.index')->with($notification);
    }

    public function documentCategoryDestroy($id)
    {
        $data = DocumentCategory::find($id);
        $log = 'Category '.($data->category_name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Category '.($data->category_name).' Deleted',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('docCat.index')->with($notification);
    }

    public function grievanceCategoryIndex()
    {
        $data = GrievanceCategory::orderBy('id','ASC')->get();

    	return view('apps.pages.grievanceCategory',compact('data'));
    }

    public function grievanceCategoryStore(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
        ]);

        $data = GrievanceCategory::create([
            'category_name' => $request->input('category_name'),
            'created_by' => auth()->user()->id,
        ]);

        $log = 'Category '.($data->category_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Category '.($data->category_name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('grievCat.index')->with($notification);
    }

    public function grievanceCategoryEdit($id)
    {
        $data = GrievanceCategory::find($id);

        return view('apps.edit.grievanceCategory',compact('data'))->renderSections()['content'];
    }

    public function grievanceCategoryUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'category_name' => 'required',
        ]);
        $orig = GrievanceCategory::find($id);
        $data = $orig->update([
            'category_name' => $request->input('category_name'),
            'updated_by' => auth()->user()->id,
        ]);

        $log = 'Category '.($orig->category_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Category '.($orig->category_name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('grievCat.index')->with($notification);
    }

    public function grievanceCategoryDestroy($id)
    {
        $data = GrievanceCategory::find($id);
        $log = 'Category '.($data->category_name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Category '.($data->category_name).' Deleted',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('grievCat.index')->with($notification);
    }

    public function coaCategoryIndex()
    {
        $data = ChartOfAccount::orderBy('account_id','ASC')->get();
        $categories = CoaCategory::orderBy('id','ASC')->pluck('category_name','id')->toArray();
        
    	return view('apps.pages.coaCategory',compact('data','categories'));
    }

    public function coaCategoryStore(Request $request)
    {
        $this->validate($request, [
            'account_id' => 'required',
            'account_name' => 'required',
            'account_category' => 'required',
        ]);

        $data = ChartOfAccount::create([
            'account_id' => $request->input('account_id'),
            'account_name' => $request->input('account_name'),
            'account_category' => $request->input('account_category'),
            'opening_balance' => $request->input('opening_balance'),
            'created_by' => auth()->user()->employee_id,
        ]);

        $log = 'Category '.($data->account_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Category '.($data->account_name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('coaCat.index')->with($notification);
    }

    public function coaImport(Request $request)
    {
        $request->validate([
            'coa' => 'required|file|mimes:xlsx,xls,XLSX,XLS'
        ]);

        $input = $request->all();
        
        $data = Excel::toArray(new CoaImport, $request->file('coa'))[0];
       
        foreach($data as $index=> $value) {
            $result = BankStatement::create([
                'account_id' => $row['account_id'],
                'account_name' => $row['account_name'],
                'account_category' => $row['account_category'],
                'opening_balance' => $row['opening_balance'],
            ]);
        }
        
        $log = 'Chart Of Account Successfully Import';
        \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Chart Of Account Successfully Import',
            'alert-type' => 'success'
        );
        
        return redirect()->route('coaCat.index')->with($notification);
    }

    public function coaCategoryEdit($id)
    {
        $data = ChartOfAccount::find($id);
        $categories = CoaCategory::orderBy('id','ASC')->pluck('category_name','id')->toArray();

        return view('apps.edit.coaCategory',compact('data','categories'))->renderSections()['content'];
    }

    public function coaCategoryUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'account_name' => 'required',
        ]);
        $orig = ChartOfAccount::find($id);
        $data = $orig->update([
            'account_id' => $request['account_id'],
            'account_name' => $request->input('account_name'),
            'account_category' => $request->input('account_category'),
            'updated_by' => auth()->user()->id,
        ]);

        $log = 'Category '.($orig->category_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Category '.($orig->category_name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('coaCat.index')->with($notification);
    }

    public function coaCategoryDestroy($id)
    {
        $data = ChartOfAccount::find($id);
        $log = 'Category '.($data->category_name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Category '.($data->category_name).' Deleted',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('coaCat.index')->with($notification);
    }

    public function bankAccountIndex()
    {
        $data = BankAccount::get();
        $accounts = ChartOfAccount::where('account_category','1')->pluck('account_name','id')->toArray();

        return view('apps.pages.bankAccount',compact('data','accounts'));
    }

    public function bankAccountStore(Request $request)
    {
        $this->validate($request, [
            'bank_name' => 'required',
            'account_no' => 'required',
            'chart_id' => 'required',
            'opening_balance' => 'required',
            'opening_date' => 'required',
        ]);

        $data = BankAccount::create([
            'bank_name' => $request->input('bank_name'),
            'account_no' => $request->input('account_no'),
            'chart_id' => $request->input('chart_id'),
            'opening_balance' => $request->input('opening_balance'),
            'opening_date' => $request->input('opening_date'),
            'active' => '1',
            'created_by' => auth()->user()->employee_id,
        ]);

        $statement = BankStatement::create([
            'bank_account_id' => $data->id,
            'transaction_date' => $data->opening_date,
            'amount' => $data->opening_balance,
            'balance' => $data->opening_balance,
            'type' => 'Debit',
            'description' => 'Saldo Awal',
            'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6',
        ]);

        $accounts = AccountStatement::create([
            'transaction_date' => $data->opening_date,
            'total' => $data->opening_balance,
            'balance' => $data->opening_balance,
            'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6',
            'created_by' => auth()->user()->employee_id,
        ]);

        $updateBalance = ChartOfAccount::where('id',$data->chart_id)->update([
            'opening_balance' => $data->opening_balance,
        ]);

        $log = 'Bank Record For '.($data->bank_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Bank Record For '.($data->bank_name).' Created',
            'alert-type' => 'success'
        );
        
        return redirect()->route('bankAcc.index')->with($notification);
    }

    public function bankAccountEdit($id)
    {
        $data = BankAccount::find($id);

        return view('apps.edit.bankAccount',compact('data'))->renderSections()['content'];
    }

    public function bankAccountUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'bank_name' => 'required',
            'account_no' => 'required',
            'chart_id' => 'required',
        ]);

        $data = BankAccount::find($id);
        $changes = $data->update([
            'bank_name' => $request->input('bank_name'),
            'account_no' => $request->input('account_no'),
            'chart_id' => $request->input('chart_id'),
            'updated_by' => auth()->user()->employee_id,
        ]);

        $log = 'Bank Record For '.($data->bank_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Bank Record For '.($data->bank_name).' Updated',
            'alert-type' => 'success'
        );
        
        return redirect()->route('bankAcc.index')->with($notification);
    }

    public function bankAccountDelete($id)
    {
        $data = BankAccount::find($id);
        $log = 'Bank Record For '.($data->bank_name).' Delete';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Bank Record For '.($data->bank_name).' Delete',
            'alert-type' => 'success'
        );

        $data->delete();

        return redirect()->route('bankAcc.index')->with($notification);
    }

    public function assetCategoryIndex()
    {
        $data = AssetCategory::orderBy('id','ASC')->get();
        $depAccounts = ChartOfAccount::where('account_category','2')->orderBy('account_id','ASC')->pluck('account_name','id')->toArray();
        $expAccounts = ChartOfAccount::where('account_category','5')->orderBy('account_id','ASC')->pluck('account_name','id')->toArray();
    	return view('apps.pages.assetCategory',compact('data','depAccounts','expAccounts'));
    }

    public function assetCategoryStore(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'charts_id' => 'required',
            'depreciate_id' => 'required',
        ]);

        $data = AssetCategory::create([
            'category_name' => $request->input('category_name'),
            'chart_of_account_id' => $request->input('charts_id'),
            'depreciation_account_id' => $request->input('depreciate_id'),
        ]);

        $log = 'Asset Category '.($data->category_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset Category '.($data->category_name).' Created',
            'alert-type' => 'success'
        );
        
        return redirect()->route('assetCat.index')->with($notification);
    }

    public function assetCategoryEdit($id)
    {
        $data = AssetCategory::find($id);
        $accounts = ChartOfAccount::orderBy('account_id','ASC')->pluck('account_name','id')->toArray();

        return view('apps.edit.assetCategory',compact('data','accounts'))->renderSections()['content'];
    }

    public function assetCategoryUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'charts_id' => 'required',
            'depreciate_id' => 'required',
        ]);

        $data = AssetCategory::find($id);
        $changes = $data->update([
            'category_name' => $request->input('category_name'),
            'chart_of_account_id' => $request->input('charts_id'),
            'depreciation_account_id' => $request->input('depreciate_id'),
        ]);

        $log = 'Asset Category '.($data->category_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset Category '.($data->category_name).' Updated',
            'alert-type' => 'success'
        );
        
        return redirect()->route('assetCat.index')->with($notification);
    }

    public function assetCategoryDestroy($id)
    {
        $data = AssetCategory::find($id);
        $log = 'Asset Category '.($data->category_name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset Category '.($data->category_name).' Deleted',
            'alert-type' => 'success'
        );

        $data->delete();

        return redirect()->route('assetCat.index')->with($notification);
    }

    public function accountingSetIndex()
    {
        return view('apps.pages.accountingSetting');
    }

    public function hrSetIndex()
    {
        return view('apps.pages.hrSetting');
    }

    public function userIndex()
    {
        $data = User::orderBy('id','ASC')->get();
        $roles = Role::pluck('name','name')->all();

        return view('apps.pages.users',compact('data','roles'));
    }

    public function userStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        
        $log = 'User '.($user->name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        
        return view('apps.edit.users',compact('user','roles','userRole'))->renderSections()['content'];
    }

    public function userUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all(); 
        
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }
        $user = User::find($id);
        $user->update($input);
        
        DB::table('model_has_roles')->where('model_id',$id)->delete();        
        $user->assignRole($request->input('roles'));
        
        $log = 'User '.($user->name).' Berhasil diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = Auth::user();
        $user->update($input);

        $log = 'Password User '.($user->name).' Changed';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Password User '.($user->name).' Changed',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function userReActivate($id)
    {
        $input = ['status_id' => '13ca0601-de87-4d58-8ccd-d1f01dba78d8'];
        $user = User::find($id);
        $user->update($input);
        
        $log = 'User '.($user->name).' Re Activate';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Re Activate',
            'alert-type' => 'success'
        );
        return redirect()->route('user.index')
                        ->with($notification);
    }

    public function userSuspend($id)
    {
        $input = ['status_id' => 'bca5aaf9-c7ff-4359-9d6c-28768981b416'];
        $user = User::find($id);
        $user->update($input);
        
        $log = 'User '.($user->name).' Suspended';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Suspended',
            'alert-type' => 'success'
        );
        return redirect()->route('user.index')
                        ->with($notification);
    }

    public function userDestroy($id)
    {
        $user = User::find($id);
        
        $log = 'User '.($user->name).' Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Dihapus',
            'alert-type' => 'success'
        );
        $user->delete();
        return redirect()->route('user.index')
                        ->with($notification);
    }

    public function roleIndex()
    {
        $roles = Role::orderBy('id','ASC')->get();
        return view('apps.pages.roles',compact('roles'));
    }

    public function roleCreate()
    {
        return view('apps.input.roles');
    }

    public function roleStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        $log = 'Access Role '.($role->name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Access Role '.($role->name).' Created',
            'alert-type' => 'success'
        ); 

        return redirect()->route('role.index')
                        ->with($notification);
    }

    public function roleEdit($id)
    {
            $data = Role::find($id);
            $permission = Permission::get();
            $roles = Role::join('role_has_permissions','role_has_permissions.role_id','=','roles.id')
                           ->where('roles.id',$id)
                           ->get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                /*->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')*/
                ->get();
            
            return view('apps.edit.roles',compact('data','rolePermissions','roles'));
    }

    public function roleUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));
        $log = 'Access Role '.($role->name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Access Role '.($role->name).' Updated',
            'alert-type' => 'success'
        ); 

        return redirect()->route('role.index')
                        ->with($notification);
    }

    public function roleDestroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        $log = 'Access Role '.($role->name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Access Role '.($role->name).' Deleted',
            'alert-type' => 'success'
        ); 
        return redirect()->route('role.index')
                        ->with($notification);
    }

    public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();
        return view('apps.pages.logActivity',compact('logs'));
    }

    public function organizationIndex()
    {
        $data = Organization::orderBy('id','ASC')->get();
        $parents = Organization::orderBy('id','ASC')->pluck('name','name')->toArray();

        return view('apps.pages.organization',compact('data','parents'));
    }

    public function organizationStore(Request $request)
    {
        $data = Organization::create([
            'name' => $request->input('name'),
            'parent' => $request->input('parent'),
        ]);

        $log = ''.($data->name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => ''.($data->name).' Created',
            'alert-type' => 'success'
        ); 
        return redirect()->route('organization.index')->with($notification);
    }

    public function organizationEdit($id)
    {
        $data = Organization::find($id);
        $parents = Organization::orderBy('id','ASC')->pluck('name','name')->toArray();

        return view('apps.edit.organization',compact('data','parents'))->renderSections()['content'];
    }

    public function organizationUpdate(Request $request,$id)
    {
        $data = Organization::find($id);
        $changes = $data->update([
            'name' => $request->input('name'),
            'parent' => $request->input('parent'),
        ]);

        $log = ''.($data->name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => ''.($data->name).' Updated',
            'alert-type' => 'success'
        ); 
        return redirect()->route('organization.index')->with($notification);
    }

    public function officeIndex()
    {
        $data = Office::orderBy('id','ASC')->get();
        $provinces = Province::orderBy('id','ASC')->pluck('province_name','id')->toArray();

        return view('apps.pages.office',compact('data','provinces'));
    }

    public function get_cities(Request $request)
    {
        if (!$request->province) {
            $html = '<option value="">Please Select</option>';
        } else {
            $html = '';
            $cities = City::where('province_id', $request->province)->get();
            foreach ($cities as $city) {
                $html .= '<option value="'.$city->id.'">'.$city->city_name.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    public function officeStore(Request $request)
    {
        $data = Office::create([
            'office_name' => $request->input('office_name'),
            'office_address' => $request->input('office_address'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
        ]);

        $log = ''.($data->office_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => ''.($data->office_name).' Created',
            'alert-type' => 'success'
        ); 
        return redirect()->route('office.index')->with($notification);
    }

    public function officeEdit($id)
    {
        $data = Office::find($id);
        $provinces = Province::orderBy('id','ASC')->pluck('province_name','id')->toArray();
        $cities = City::orderBy('id','ASC')->pluck('city_name','id')->toArray();

        return view('apps.edit.office',compact('data','provinces','cities'))->renderSections()['content'];
    }

    public function officeUpdate(Request $request,$id)
    {
        $data = Office::find($id);
        $changes = $data->update([
            'office_name' => $request->input('office_name'),
            'office_address' => $request->input('office_address'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
        ]);

        $log = ''.($data->office_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => ''.($data->office_name).' Updated',
            'alert-type' => 'success'
        ); 
        return redirect()->route('office.index')->with($notification);
    }

    public function holidayIndex()
    {
        $data = Holiday::orderBy('holiday_start','ASC')->get();

        return view('apps.pages.holidayIndex',compact('data'));
    }

    public function holidayStore(Request $request)
    {
        $data = Holiday::create([
            'holiday_name' => $request->input('name'),
            'holiday_start' => $request->input('holiday_start'),
            'holiday_end' => $request->input('holiday_end'),
            'leave_status' => $request->input('leave_status'),
        ]);

        return redirect()->route('holiday.index');
    }

    public function holidayEdit($id)
    {

    }

    public function holidayUpdate(Request $request,$id)
    {

    }

    public function holidayDelete($id)
    {

    }
}
