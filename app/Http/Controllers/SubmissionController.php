<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Submission;
use Yajra\Datatables\Datatables;

use Validator;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome'],
            (object) ['name' => 'Submission a paper', 'link' => 'submission']
        );

        return view('pages/submission/common-list', compact('breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome'],
            (object) ['name' => 'Submission a paper', 'link' => 'submission'],
            (object) ['name' => 'New Submit', 'link' => 'submission/create']
        );
        
        $item = null;
        $extra = false;

        return view('pages/submission/manage-item', compact('breadcrumb', 'item', 'extra'));
    }

    public function indexAddExtra($id)
    {
        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome'],
            (object) ['name' => 'Submission a paper', 'link' => 'submission'],
            (object) ['name' => 'Submit Full Paper', 'link' => 'submission/add-extra/'.$id]
        );

        $item = Submission::findOrFail($id);
        $extra = true;

        return view('pages/submission/manage-item', compact('breadcrumb', 'item', 'extra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }
        $item = new Submission;
        $item->submission_number = 'SP-'.time();
        $item->fullname = strtoupper($request->fullname);
        $item->institution = strtoupper($request->institution);
        $item->phone = $request->phone;
        $item->line_id = $request->line_id;
        $item->title = $request->title;
        $item->abstract = $request->abstract;
        $item->submission_purpose = $request->submission_purpose;

        if($request->hasFile('paper_file')){
            $paper_file = $request->file('paper_file');
            
            $filename = pathinfo($paper_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($paper_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $paper_file->move(public_path('uploads'), $filename_new);
            $item->paper_url = '/uploads/'.$filename_new;
        }

        if($request->hasFile('full_paper_file')){
            $full_paper_file = $request->file('full_paper_file');
            
            $filename = pathinfo($full_paper_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($full_paper_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $full_paper_file->move(public_path('uploads'), $filename_new);
            $item->full_paper_url = '/uploads/'.$filename_new;
        }

        if($request->hasFile('student_id')){
            $student_id = $request->file('student_id');
            
            $filename = pathinfo($student_id->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($student_id->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $student_id->move(public_path('uploads'), $filename_new);
            $item->student_id = '/uploads/'.$filename_new;
        }

        $item->submission_status = !empty($request->input_status)? 100 : 0;

        $item->created_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses menambah topik');
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $dt
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $dt = null){
        $list_data = Submission::byUser(auth_data()->user_id);

        if(!empty($request->filter)){
            $list_data = $list_data->whereIn('submission_status', $request->filter);
        }

        return Datatables::of($list_data)
                ->addColumn('status', function($item){
                    return $item->statusToText();
                })
                ->addColumn('action', function($item){
                    $data = array(
                        'id' => $item->submission_id,
                        'status' => $item->submission_status,
                        'notes' => $item->notes,
                        'submission_url' => $item->submission_url,
                    );
                    return $data;
                })
                ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome'],
            (object) ['name' => 'Submission a paper', 'link' => 'submission'],
            (object) ['name' => 'Revisi dan Submit Kembali', 'link' => 'submission/'.$id.'/edit']
        );
        $item = Submission::findOrFail($id);
        $extra = false;

        return view('pages/submission/manage-item', compact('breadcrumb', 'item', 'extra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }
        $item = Submission::findOrFail($id);
        if($request->hasFile('full_paper_file')){
            $full_paper_file = $request->file('full_paper_file');
            
            $filename = pathinfo($full_paper_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($full_paper_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $full_paper_file->move(public_path('uploads'), $filename_new);
            $item->full_paper_url = '/uploads/'.$filename_new;
        }

        if($request->hasFile('student_id')){
            $student_id = $request->file('student_id');
            
            $filename = pathinfo($student_id->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($student_id->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $student_id->move(public_path('uploads'), $filename_new);
            $item->student_id = '/uploads/'.$filename_new;
        }

        $item->submission_status = !empty($request->input_status)? 100 : 0;
        $item->updated_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses merevisi pengajuan');
    }

    public function actionAddExtra(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }
        $item = Submission::findOrFail($id);

        if($request->hasFile('full_paper_file')){
            $full_paper_file = $request->file('full_paper_file');
            
            $filename = pathinfo($full_paper_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($full_paper_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $full_paper_file->move(public_path('uploads'), $filename_new);
            $item->full_paper_url = '/uploads/'.$filename_new;
        }

        $item->submission_status = !empty($request->input_status)? 100 : 0;
        $item->updated_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses merevisi pengajuan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
