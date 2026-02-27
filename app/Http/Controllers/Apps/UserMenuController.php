<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Employee;
use iteos\Models\EmployeeEducation;
use iteos\Models\Location;
use iteos\Models\EmployeeAttendance;
use iteos\Models\AttendanceTransaction;
use iteos\Models\EmployeeLeave;
use iteos\Models\LeaveTransaction;
use iteos\Models\LeaveType;
use iteos\Models\EmployeeReimbursment;
use iteos\Models\EmployeeService;
use iteos\Models\EmployeeTraining;
use iteos\Models\ReimbursType;
use iteos\Models\EmployeeGrievance;
use iteos\Models\GrievanceComment;
use iteos\Models\GrievanceCategory;
use iteos\Models\EmployeeAppraisal;
use iteos\Models\AppraisalData;
use iteos\Models\AppraisalTarget;
use iteos\Models\AppraisalComment;
use iteos\Models\AppraisalAdditionalRole;
use iteos\Models\Bulletin;
use iteos\Models\KnowledgeBase;
use iteos\Models\EmployeeSalary;
use iteos\Models\EmployeeFamily;
use iteos\Models\TargetData;
use Auth;
use DB;
use PDF;
use Carbon\Carbon;
use DateTime;

class UserMenuController extends Controller
{
    public function index()
    {
        /*Master Query*/
        $getEmployee = Employee::where('id',Auth()->user()->employee_id)->first();
        if($getEmployee == null) {
            return view('apps.pages.dashboard');
        } else {
            /*Query for Profile Card*/
            $getBasicProfile = Employee::join('employee_services','employee_services.employee_id','employees.id')
                                    ->join('employee_leaves','employee_leaves.employee_id','employees.id')
                                    ->where('employees.id',auth()->user()->employee_id)
                                    ->orderBy('employee_services.from','ASC')
                                    ->first();
            $tDate = Carbon::now();
            $interval = $tDate->diff($getBasicProfile->from);
            $totalDays = $interval->format('%a');
            $getCurPos = EmployeeService::where('employee_id',auth()->user()->employee_id)->orderBy('from','DESC')->first(); 
            /*Query for Attendance Card*/
            $getAttendance = EmployeeAttendance::where('employee_id',$getEmployee->id)->whereDate('updated_at',Carbon::today())->first();
            /*Query for User Card*/
            $getLastEdu = EmployeeEducation::where('employee_id',auth()->user()->employee_id)->orderBy('date_of_graduate','DESC')->first();
            $getTraining = EmployeeTraining::where('employee_id',auth()->user()->employee_id)->where('status','caf3f6a0-3aef-4984-8a87-1684579c5e45')->get();
            $getSubordinate = EmployeeService::with('Parent')->where('report_to',auth()->user()->employee_id)->get();
            $getFamily = EmployeeFamily::where('employee_id',auth()->user()->employee_id)->get();
            $getSalary = EmployeeSalary::where('employee_no',$getEmployee->employee_no)->where('status_id','ca52a2ce-5c37-48ce-a7f2-0fd5311860c2')
                    ->orderBy('payroll_period','DESC')->get();
            $getServices = EmployeeService::where('employee_id',$getEmployee->id)->orderBy('from','ASC')->first();
            /*Query for Bulletin Board*/
            $getBulletin = Bulletin::orderBy('updated_at','DESC')->get();
            $getKnowledge = KnowledgeBase::orderBy('updated_at','DESC')->get();
            /*Query for Birthday Card*/
            $getBirthday = Employee::whereMonth('date_of_birth',Carbon::now()->month)->get();
            
            return view('apps.pages.userHome',compact('getBasicProfile','getEmployee','getAttendance','totalDays','getLastEdu','getSubordinate','getBulletin','getKnowledge','getCurPos','getBirthday','getSalary','getServices',
            'getFamily'));
        }  
    }
    public function clockIn(Request $request)
    {
        $this->validate($request, [
            'notes' => 'required|min:20',
        ]);

    	$clockIn = EmployeeAttendance::create([
    		'employee_id' => Auth()->user()->employee_id,
    		'status_id' => 'f4f23f41-0588-4111-a881-a043cf355831',
    	]);

        $attendanceIn = AttendanceTransaction::create([
            'attendance_id' => $clockIn->id,
            'clock_in' => Carbon::now(),
            'notes' => $request->input('notes'),
        ]);

    	return redirect()->back();
    }

    public function taskEdit(Request $request)
    {
        $this->validate($request, [
            'notes' => 'required|min:100',
        ]);

        $getData = EmployeeAttendance::where('employee_id',auth()->user()->employee_id)->orderBy('updated_at','DESC')->first();
        $attendanceOut = AttendanceTransaction::where('attendance_id',$getData->id)->update([
            'notes' => $request->input('notes'),
        ]);

        return redirect()->back();
    }

    public function clockOut(Request $request)
    {
        $this->validate($request, [
            'notes' => 'required|min:100',
        ]);
        
        $getData = EmployeeAttendance::join('attendance_transactions','attendance_transactions.attendance_id','employee_attendances.id')
                                        ->where('employee_attendances.employee_id',auth()->user()->employee_id)
                                        ->orderBy('employee_attendances.updated_at','DESC')
                                        ->first();
        $getId = $getData->attendance_id;
        $getTime = Carbon::now();
        $work = $getTime->diffInHours($getData->clock_in);
        $clockOut = EmployeeAttendance::where('id',$getId)->update([
            'working_hour' => $work,
            'status_id' => '2dc764a0-f110-4985-922d-0ffb81363899',
        ]);

        $attendanceOut = AttendanceTransaction::where('attendance_id',$getData->attendance_id)->update([
            'clock_out' => $getTime,
            'notes' => $request->input('notes'),
        ]);

    	return redirect()->back();
    }

    public function salaryPrint($empNo)
    {
        $data = EmployeeSalary::join('employees','employees.employee_no','employee_salaries.employee_no')
                                ->join('employee_services','employee_services.employee_id','employees.id')
                                ->where('employee_salaries.employee_no',$empNo)
                                ->where('employee_services.is_active','1')
                                ->first();
                                
        $iuran = $data->jkk + $data->jkm + $data->jht + $data->jp;
        $income = $data->nett_salary + $iuran + $data->bpjs + $data->income_tax;
        $outcome = $iuran + $data->bpjs + $data->income_tax;
        $nett = $income - $outcome;
        return view('apps.print.mySalaryPrint',compact('data','iuran','income','outcome','nett'));
    }

    public function salaryPdf($empNo)
    {
        $data = EmployeeSalary::join('employees','employees.employee_no','employee_salaries.employee_no')
                                ->join('employee_services','employee_services.employee_id','employees.id')
                                ->where('employee_salaries.employee_no',$empNo)
                                ->where('employee_services.is_active','1')
                                ->first();
                                
        $iuran = $data->jkk + $data->jkm + $data->jht + $data->jp;
        $income = $data->nett_salary + $iuran + $data->bpjs + $data->income_tax;
        $outcome = $iuran + $data->bpjs + $data->income_tax;
        $nett = $income - $outcome;
        $filename = $empNo;
        
        $pdf = PDF::loadview('apps.print.mySalaryPdf',compact('data','iuran','income','outcome','nett'))->setPaper('a4','landscape');
        
        return $pdf->download(''.$filename.'.pdf');
    }

    public function profileData() 
    {
        $data = Employee::where('id',auth()->user()->employee_id)->first();
        
        return view('apps.pages.myProfile',compact('data'));
    }

    public function familyData()
    {
        $data = Employee::where('id',auth()->user()->employee_id)->first();

        return view('apps.pages.myFamily',compact('data'));
    }

    public function educationData()
    {
        $data = Employee::where('id',auth()->user()->employee_id)->first();
        $degrees  = DB::table('education_degree')->pluck('degree_name','degree_name')->toArray();

        return view('apps.pages.myEducation',compact('data','degrees'));
    }

    public function leaveIndex()
    {
    	$getEmployee = Employee::where('email',Auth()->user()->email)->first();
    	$data = EmployeeLeave::where('employee_id',$getEmployee->id)->orderBy('created_at','DESC')->first();
        $types = LeaveType::pluck('leave_name','id')->toArray();
        $details = LeaveTransaction::where('leave_id',$data->id)->orderBy('created_at','DESC')->get();
        
    	return view('apps.pages.myLeave',compact('getEmployee','details','types'));
    }

    public function leaveRequest(Request $request) 
    {
    	$this->validate($request, [
            'timeoff_type' => 'required',
            'notes' => 'required',
        ]);
        if($request->input('timeoff_type') == '4') {
            if($request->input('request_type') == '1') {
                $data = EmployeeLeave::where('employee_id',Auth()->user()->employee_id)->where('period',Carbon::now()->year)->first();
                $details = LeaveTransaction::create([
                    'leave_id' => $data->id,
                    'timeoff_type' => $request->input('timeoff_type'),
                    'leave_type' => 'After Break',
                    'leave_start' => $request->input('date'),
                    'leave_end' => $request->input('date'),
                    'notes' => $request->input('notes'),
                    'amount_requested' => '1',
                    'status_id' => 'b0a0c17d-e56a-41a7-bfb0-bd8bdc60a7be',
                ]);

                $log = 'Time Off Request For'.($details->leave_start).' Created';
                \LogActivity::addToLog($log);
                $notification = array (
                    'message' => 'Time Off Request For'.($details->leave_start).' Created',
                    'alert-type' => 'success'
                );
                
                return redirect()->route('myLeave.index')->with($notification);
            } else {
                if($request->input('time_before') == null) {
                    $data = EmployeeLeave::where('employee_id',Auth()->user()->employee_id)->where('period',Carbon::now()->year)->first();
                    $details = LeaveTransaction::create([
                        'leave_id' => $data->id,
                        'timeoff_type' => $request->input('timeoff_type'),
                        'leave_type' => 'After Break',
                        'leave_start' => $request->input('date'),
                        'leave_end' => $request->input('date'),
                        'schedule_out' => $request->input('time_after'),
                        'notes' => $request->input('notes'),
                        'amount_requested' => '0',
                        'status_id' => 'b0a0c17d-e56a-41a7-bfb0-bd8bdc60a7be',
                    ]);

                    $log = 'Time Off Request For'.($details->leave_start).' Created';
                    \LogActivity::addToLog($log);
                    $notification = array (
                        'message' => 'Time Off Request For'.($details->leave_start).' Created',
                        'alert-type' => 'success'
                    );
                    
                    return redirect()->route('myLeave.index')->with($notification);
                } else {
                    $data = EmployeeLeave::where('employee_id',Auth()->user()->employee_id)->where('period',Carbon::now()->year)->first();
                    $details = LeaveTransaction::create([
                        'leave_id' => $data->id,
                        'timeoff_type' => $request->input('timeoff_type'),
                        'leave_type' => 'Before Break',
                        'leave_start' => $request->input('date'),
                        'leave_end' => $request->input('date'),
                        'schedule_in' => $request->input('time_before'),
                        'notes' => $request->input('notes'),
                        'amount_requested' => '0',
                        'status_id' => 'b0a0c17d-e56a-41a7-bfb0-bd8bdc60a7be',
                    ]);

                    $log = 'Time Off Request For'.($details->leave_start).' Created';
                    \LogActivity::addToLog($log);
                    $notification = array (
                        'message' => 'Time Off Request For'.($details->leave_start).' Created',
                        'alert-type' => 'success'
                    );
                    
                    return redirect()->route('myLeave.index')->with($notification);
                }
            }
        } else {
            $start = new DateTime($request->input('date_start'));
            $end = new DateTime($request->input('date_end'));
            $long = $start->diff($end);
            $data = EmployeeLeave::where('employee_id',Auth()->user()->employee_id)->where('period',Carbon::now()->year)->first();
            $details = LeaveTransaction::create([
                'leave_id' => $data->id,
                'timeoff_type' => $request->input('timeoff_type'),
                'leave_type' => 'Before Break',
                'leave_start' => $request->input('date_start'),
                'leave_end' => $request->input('date_end'),
                'notes' => $request->input('notes'),
                'amount_requested' => $long->d,
                'status_id' => 'b0a0c17d-e56a-41a7-bfb0-bd8bdc60a7be',
            ]);

            $log = 'Time Off Request For '.($details->leave_start).' Created';
            \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Time Off Request For '.($details->leave_start).' Created',
                'alert-type' => 'success'
            );
                    
            return redirect()->route('myLeave.index')->with($notification);
        }
    }

    public function reimbursIndex()
    {
    	$getEmployee = Employee::where('email',Auth()->user()->email)->first();
    	$data = EmployeeReimbursment::where('employee_id',auth()->user()->employee_id)->orderBy('created_at','DESC')->get();
    	$types = ReimbursType::pluck('reimburs_name','id')->toArray();

    	return view('apps.pages.myReimburs',compact('getEmployee','data','types'));
    }

    public function reimbursStore(Request $request)
    {
    	$this->validate($request, [
            'request_type' => 'required',
            'amount' => 'required',
            'notes' => 'required',
        ]);

    	if($request->hasFile('receipt')) {
    		$file = $request->file('receipt')->store('employees_reimburs');

            $data = EmployeeReimbursment::create([
	        	'employee_id' => $request->input('employee_id'),
	        	'transaction_date' => $request->input('transaction_date'),
	        	'type_id' => $request->input('request_type'),
	        	'amount' => $request->input('amount'),
	        	'notes' => $request->input('notes'),
	        	'files' => $file,
	        	'status_id' => 'b0a0c17d-e56a-41a7-bfb0-bd8bdc60a7be',
	        ]);

	        return redirect()->route('myReimburs.index');
    	} else {
    		$data = EmployeeReimbursment::create([
	        	'employee_id' => $request->input('employee_id'),
	        	'transaction_date' => $request->input('transaction_date'),
	        	'type_id' => $request->input('request_type'),
	        	'amount' => $request->input('amount'),
	        	'notes' => $request->input('notes'),
	        	'status_id' => 'b0a0c17d-e56a-41a7-bfb0-bd8bdc60a7be',
	        ]);

	        return redirect()->route('myReimburs.index');
    	}  
    }

    public function grievanceIndex()
    {
        $getEmployee = Employee::where('email',Auth()->user()->email)->first();
        $data = EmployeeGrievance::where('employee_id',$getEmployee->id)
                                    ->orderBy('created_at','DESC')->get();
    	
    	return view('apps.pages.myGrievance',compact('data'));
    }

    public function grievanceCreate()
    {
    	$getEmployee = Employee::where('email',Auth()->user()->email)->first();
    	$types = GrievanceCategory::pluck('category_name','id')->toArray();

    	return view('apps.input.myGrievance',compact('getEmployee','types'));
    }

    public function grievanceStore(Request $request)
    {
    	$this->validate($request, [
            'subject' => 'required',
            'type_id' => 'required',
            'description' => 'required',
        ]);

        $content = $request->input('description');
        $dom = new\DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $isi = $img->getAttribute('src');
            list($type, $data) = explode(';', $isi);
            list(, $isi) = explode(',', $isi);
            $isi = base64_decode($isi);
            $image_name = "/grievance_image/" . time().$k.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $isi);
            $access = "http://betterwork.local/public".$image_name;
            $img->removeAttribute('src');
            $img->setAttribute('src', $access);
        }
        $content = $dom->saveHtml();

        if($request->input('is_public') == 'on') {
        	$data = EmployeeGrievance::create([
	        	'employee_id' => auth()->user()->employee_id,
	        	'subject' => $request->input('subject'),
	        	'type_id' => $request->input('type_id'),
	        	'is_public' => '1',
	        	'description' => $content,
	        	'status_id' => '1f2967a5-9a88-4d44-a66b-5339c771aca0',
	        ]);
        } else {
        	$data = EmployeeGrievance::create([
	        	'employee_id' => auth()->user()->employee_id,
	        	'subject' => $request->input('subject'),
	        	'type_id' => $request->input('type_id'),
	        	'description' => $content,
	        	'status_id' => '1f2967a5-9a88-4d44-a66b-5339c771aca0',
	        ]);
        }

        $log = 'Grievance'.($data->subject). ' Submitted';
        \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Grievance'.($data->subject). ' Submitted',
            'alert-type' => 'success'
        );

        return redirect()->route('myGrievance.index')->with($notification); 
    }

    public function grievanceShow($id)
    {
    	$data = EmployeeGrievance::find($id);

    	return view('apps.show.myGrievance',compact('data'));
    }

    public function grievanceEdit($id)
    {

    }

    public function grievanceUpdate(Request $request,$id)
    {

    }

    public function grievanceComment(Request $request,$id)
    {
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $content = $request->input('comment');
         libxml_use_internal_errors(true);
        $dom = new\DomDocument();   
        $dom->loadHTML(
            mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'),
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');

            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];

                $path = '/grievance_image/' . uniqid('', true) . '.' . $mimeType;

                Image::make($src)
                    ->resize(750, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode($mimeType, 80)
                    ->save(public_path($path));

                $image->removeAttribute('src');
                $image->setAttribute('src', asset($path));
            }
        }
        $content = $dom->saveHTML();

        $data = EmployeeGrievance::find($id);
        if(($data->status_id) == '16f30bee-5db5-472d-b297-926f5c8e4d21') {
            $data->update([
                'status_id' => 'fe6f8153-a433-4a4d-a23d-201811778733',
            ]);
            $comments = GrievanceComment::create([
                'grievance_id' => $id,
                'comment' => $content,
                'comment_by' => auth()->user()->employee_id,
            ]);
        } else {
            $comments = GrievanceComment::create([
                'grievance_id' => $id,
                'comment' => $content,
                'comment_by' => auth()->user()->employee_id,
            ]);
        }
        

        return redirect()->back();
    }

    public function grievanceRate(Request $request,$id)
    {
        $data = EmployeeGrievance::find($id);
        $data->update([
            'status_id' => '6a787298-14f6-4d19-a7ee-99a3c8ed6466',
            'rating' => $request->input('rating'),
        ]);

        return redirect()->route('myGrievance.index');
    }

    public function grievancePublish()
    {
        $data = EmployeeGrievance::where('status_id','6a787298-14f6-4d19-a7ee-99a3c8ed6466')
                                    ->where('is_public','1')
                                    ->get();

        return view('apps.pages.myGrievancePublished',compact('data'));
    }

    public function grievancePublishShow($id)
    {
        $data = EmployeeGrievance::find($id);

        return view('apps.show.myGrievancePublished',compact('data'));
    }

    public function appraisalIndex()
    {
        $data = EmployeeAppraisal::where('employee_id',Auth()->user()->employee_id)->orderBy('created_at','DESC')->get();

        return view('apps.pages.myAppraisal',compact('data'));
    }

    public function appraisalCreate()
    {
        return view('apps.input.myAppraisal');
    }

    public function appraisalStore(Request $request)
    {
        $getSupervisor = EmployeeService::where('employee_id',Auth()->user()->employee_id)->where('is_active','1')->first();
        $input = ([
            'employee_id' => Auth()->user()->employee_id,
            'supervisor_id' => $getSupervisor->report_to,
            'appraisal_type' => $request->input('appraisal_type'),
            'appraisal_period' => $request->input('period'),
            'status_id' => '1f2967a5-9a88-4d44-a66b-5339c771aca0',
        ]);
        $data = EmployeeAppraisal::create($input);
        $items = $request->kpi;
        foreach($items as $index=>$item)
        {
            $details = AppraisalData::create([
                'appraisal_id' => $data->id,
                'indicator' => $item,
            ]);
        }

        return redirect()->route('myAppraisal.detail',$data->id); 
    }

    public function appraisalDetail($id)
    {
        $data = EmployeeAppraisal::with('Details.Target')->find($id);
        
        return view('apps.input.myAppraisalDetail',compact('data'));
    }

    public function appraisalComment($id)
    {
        $data = AppraisalData::with('Appraisal')->find($id);

        return view('apps.input.myAppComment',compact('data'))->renderSections()['content'];
    }

    public function commentStore(Request $request)
    {
        $data = AppraisalComment::create([
            'appraisal_id' => $request->input('appraisal_id'),
            'data_id' => $request->input('data_id'),
            'comment_by' => Auth()->user()->employee_id,
            'comments' => $request->input('comments'),
        ]);

        return redirect()->back();
    }

    public function targetCreate($id)
    {
        $data = AppraisalData::with('Appraisal')->find($id);

        return view('apps.input.myTarget',compact('data'))->renderSections()['content'];
    }

    public function targetStore(Request $request)
    {
        $weight = $request->input('weight');
        $base = AppraisalTarget::where('appraisal_id',$request->input('appraisal_id'))->sum('job_weight');
        
        if(($base + $weight) <= '100') {
            $target = AppraisalTarget::create([
                'data_id' => $request->input('data_id'),
                'appraisal_id' => $request->input('appraisal_id'),
                'target' => $request->input('target'),
                'job_weight' => $request->input('weight'), 
            ]);

            $notification = array (
                'message' => 'Your Target Job Created',
                'alert-type' => 'success'
            );
        } else {
            $notification = array (
                'message' => 'Your total job weight exceed 100%, please reduce one or more job weight',
                'alert-type' => 'error'
            );
        }
        

        return redirect()->back()->with($notification);
    }

    public function developmentCreate($id)
    {
        $data = EmployeeAppraisal::find($id);
        
        return view('apps.input.myDevelopment',compact('data'));
    }

    public function developmentStore(Request $request)
    {
        $courses = $request->course;
        $outcomes = $request->outcome;
        $appraisals = $request->appraisal_id;
        foreach($courses as $index=>$course) {
            $training = EmployeeTraining::create([
                'employee_id' => Auth()->user()->employee_id,
                'training_title' => $course,
                'appraisal_id' => $appraisals[$index],
                'training_outcome' => $outcomes[$index],
                'status' => 'b0a0c17d-e56a-41a7-bfb0-bd8bdc60a7be',
            ]);
        }

        return redirect()->route('myAppraisal.index');
    }

    public function appraisalShow($id)
    {
        $data = EmployeeAppraisal::with('Details.Target')->find($id);

        return view('apps.show.myAppraisal',compact('data'));
    }

    public function appraisalEdit($id)
    {
        $data = EmployeeAppraisal::with('Details.Target')->find($id);

        return view('apps.edit.myAppraisal',compact('data'));
    }

    public function targetEdit($id)
    {
        $data = AppraisalTarget::with('Data.Appraisal')->find($id);

        return view('apps.edit.myTarget',compact('data'))->renderSections()['content'];
    }

    public function appraisalUpdate(Request $request,$id)
    {
        $data = AppraisalTarget::with('Data.Appraisal')->find($id);

        if($request->hasFile('file')) {
            $uploadedFile = $request->file('contract');
            $path = $uploadedFile->store('employee_appraisal');
            $input = ([
                'target_id' => $data->id,
                'appraisal_id' => $data->appraisal_id,
                'data_details' => $request->input('details'),
                'file' => $path,
            ]);
            $data = TargetData::create($input);
        } else {
            $input = ([
                'target_id' => $data->id,
                'appraisal_id' => $data->appraisal_id,
                'data_details' => $request->input('details'),
            ]);
            $data = TargetData::create($input);
        }
        
        return redirect()->back();
    }

    public function trainingIndex()
    {
        $data = EmployeeTraining::where('employee_id',Auth()->user()->employee_id)->get();

        return view('apps.pages.myTraining',compact('data'));
    }

    public function trainingEdit($id)
    {
        $data = EmployeeTraining::find($id);

        return view('apps.edit.myTraining',compact('data'))->renderSections()['content'];
    }

    public function trainingUpdate(Request $request,$id)
    {
        $data = EmployeeTraining::find($id);

        $certificate = '' ;
        $reports = '' ;
        $materials = '' ;

        if($request->hasFile('certificate')) {
            $uploadedFile = $request->file('certificate');
            $certificate = $uploadedFile->store('employee_training');
        }
        

        if($request->hasFile('reports')) {
            $uploadedFile = $request->file('reports');
            $reports = $uploadedFile->store('employee_training');
        }
        
        
        if($request->hasFile('materials')) {
            $uploadedFile = $request->file('materials');
            $materials = $uploadedFile->store('employee_training');
        }
        
        
        $data->update([
            'certification' => $certificate,
            'reports' => $reports,
            'materials' => $materials,
        ]);

        return redirect()->route('myTraining.index');
    }

    public function bulletinIndex()
    {
        $data = Bulletin::where('content_id','1')->orderBy('created_at','DESC')->get();

        return view('apps.pages.myBulletin',compact('data'));
    }

    public function bulletinShow($id)
    {
        $data = Bulletin::find($id);

        return view('apps.show.myBulletin',compact('data'));
    }

    public function knowledgeIndex()
    {
        $data = Bulletin::where('content_id','2')->orderBy('created_at','DESC')->get();

        return view('apps.pages.myKnowledge',compact('data'));
    }

    public function knowledgeShow($id)
    {
        $data = Bulletin::find($id);

        return view('apps.show.myKnowledge',compact('data'));
    }

    public function attendanceIndex()
    {
        $data = EmployeeAttendance::join('employees','employees.id','employee_attendances.employee_id')
                                    ->join('attendance_transactions','attendance_transactions.attendance_id','employee_attendances.id')
                                    ->where('employee_attendances.employee_id',auth()->user()->employee_id)
                                    ->get();
        
        return view('apps.pages.myAttendance',compact('data'));
    }

    public function attendanceSearch(Request $request)
    {
        $dates = $request->input('date_range');
        $dateRange = explode('-',$dates);
        $startDate = Carbon::parse($dateRange[0]);
        $endDate = Carbon::parse($dateRange[1]);

        $data = EmployeeAttendance::join('employees','employees.id','employee_attendances.employee_id')
                                    ->join('attendance_transactions','attendance_transactions.attendance_id','employee_attendances.id')
                                    ->where('employee_attendances.created_at','>=',$startDate)
                                    ->where('employee_attendances.created_at','<=',$endDate)
                                    ->get();
                                    
        return view('apps.pages.myAttendance',compact('data'));
    }

    public function helpIndex()
    {
        return view('apps.pages.help');
    }

    public function supportIndex()
    {
        return view('apps.pages.support');
    }
}
