<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\EmployeeGrievance;
use iteos\Models\GrievanceComment;
use iteos\Models\GrievanceCategory;
use iteos\Models\Employee;
use Auth;

class GrievanceController extends Controller
{
    public function index()
    {
    	return view('apps.pages.grievanceHome');
    }

    public function grievanceData()
    {
    	$data = EmployeeGrievance::where('status_id','!=','6a787298-14f6-4d19-a7ee-99a3c8ed6466')->get();

    	return view('apps.pages.grievanceIndex',compact('data'));
    }

    public function grievanceCreate()
    {
        $getEmployee = Employee::where('email',Auth()->user()->email)->first();
        $types = GrievanceCategory::pluck('category_name','id')->toArray();

        return view('apps.input.employeeGrievance',compact('getEmployee','types'));
    }

    public function managementData()
    {
    	$data = EmployeeGrievance::where('status_id','ca52a2ce-5c37-48ce-a7f2-0fd5311860c2')
                                    ->orWhere('status_id','fe6f8153-a433-4a4d-a23d-201811778733')
                                    ->get();

    	return view('apps.pages.managementGrievance',compact('data'));
    }

    public function grievanceShow($id)
    {
    	$data = EmployeeGrievance::find($id);

    	return view('apps.show.grievanceData',compact('data'));
    }

    public function grievanceManagementShow($id)
    {
    	$data = EmployeeGrievance::find($id);

    	return view('apps.show.grievanceManagement',compact('data'));
    }

    public function grievanceEdit($id)
    {
    	$data = EmployeeGrievance::find($id);
    	$types = GrievanceCategory::pluck('category_name','id')->toArray();

    	return view('apps.edit.grievanceData',compact('data','types'));
    }

    public function grievanceUpdate(Request $request,$id)
    {
    	$this->validate($request, [
            'type_id' => 'required',
            'status_id' => 'required',
            'description' => 'required',
        ]);

        $content = $request->input('description');
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

        
        if(($request->input('is_public')) == 'on') {
        	$data = EmployeeGrievance::find($id);
        	$data->update([
        		'type_id' => $request->input('type_id'),
        		'status_id' => $request->input('status_id'),
        		'is_public' => '1',
	        	'description' => $content,
        	]);
        } else {
        	$data = EmployeeGrievance::find($id);
        	$data->update([
        		'type_id' => $request->input('type_id'),
        		'status_id' => $request->input('status_id'),
        		'is_public' => '0',
	        	'description' => $content,
        	]);
        }

        return redirect()->route('grievanceData.show',$id);
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
        $getEmployee = EmployeeGrievance::find($id);
        $comments = GrievanceComment::create([
        	'grievance_id' => $id,
        	'comment' => $content,
        	'comment_by' => auth()->user()->employee_id,
        ]);

        return redirect()->back();
    }

    public function grievancePublish($id)
    {
    	$data = EmployeeGrievance::find($id);
    	$data->update([
    		'status_id' => '16f30bee-5db5-472d-b297-926f5c8e4d21',
    	]);

    	return redirect()->route('grievanceData.index');
    }

    public function grievancePublishData()
    {
        $data = EmployeeGrievance::where('status_id','6a787298-14f6-4d19-a7ee-99a3c8ed6466')
                                    ->where('is_public','1')
                                    ->get();

        return view('apps.pages.grievancePublished',compact('data'));
    }

    public function grievancePublishShow($id)
    {
        $data = EmployeeGrievance::find($id);

        return view('apps.show.grievancePublished',compact('data'));
    }
}
