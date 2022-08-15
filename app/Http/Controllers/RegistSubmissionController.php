<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LetterCategory;
use App\Models\RegistSubmission;
use Yajra\Datatables\Datatables;

use Validator;

class RegistSubmissionController extends Controller
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
            (object) ['name' => 'Regist as a Viewer or Presenter', 'link' => 'regist-submission']
        );

        $list_data = RegistSubmission::byUser(auth_data()->user_id)->get();

        return view('pages/regist-submission/common-list', compact('breadcrumb', 'list_data'));
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
            (object) ['name' => 'Regist as a Viewer or Presenter', 'link' => 'regist-submission'],
            (object) ['name' => 'Register', 'link' => 'regist-submission/create']
        );
        
        $item = null;

        return view('pages/regist-submission/manage-item', compact('breadcrumb', 'item'));
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

        $item = new RegistSubmission;
        $item->regist_submission_number = 'REG-'.time();

        $item->fullname = strtoupper($request->fullname);
        $item->institution = strtoupper($request->institution);
        $item->phone = $request->phone;
        $item->line_id = $request->line_id;
        $item->gender = $request->gender;
        $item->regist_submission_type = $request->regist_submission_type;
        // $item->attendance_option = $request->attendance_option;

        if($request->hasFile('payment_url_file')){
            $payment_url_file = $request->file('payment_url_file');
            
            $filename = pathinfo($payment_url_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($payment_url_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $payment_url_file->move(public_path('uploads'), $filename_new);
            $item->payment_url = '/uploads/'.$filename_new;
        }
        
        if(empty($item->payment_url)){
            $request->input_status = 100;
        }

        $item->regist_submission_status = !empty($request->input_status)? 100 : 0;

        $item->created_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses melakukan pengajuan');
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $dt
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $dt = null)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $item = RegistSubmission::findOrFail($id);

        if($item->regist_submission_status == 1){
            $breadcrumb_item = (object) ['name' => 'Revisi dan Ajuan Kembali', 'link' => 'regist-submission/'.$id.'/edit'];
        }else{
            $breadcrumb_item = (object) ['name' => 'Pengajuan', 'link' => 'regist-submission/'.$id.'/edit'];
        }

        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome'],
            (object) ['name' => 'Regist as a Viewer or Presenter', 'link' => 'regist-submission'],
            $breadcrumb_item
        );

        return view('pages/regist-submission/manage-item', compact('breadcrumb', 'item'));
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

        $item = RegistSubmission::findOrFail($id);
        $item->fullname = strtoupper($request->fullname);
        $item->institution = strtoupper($request->institution);
        $item->phone = $request->phone;
        $item->line_id = $request->line_id;
        $item->gender = $request->gender;
        $item->regist_submission_type = $request->regist_submission_type;

        if($request->hasFile('payment_url_file')){
            $payment_url_file = $request->file('payment_url_file');
            
            $filename = pathinfo($payment_url_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($payment_url_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $payment_url_file->move(public_path('uploads'), $filename_new);
            $item->payment_url = '/uploads/'.$filename_new;
        }

        if(empty($item->payment_url)){
            $request->input_status = 100;
        }

        $item->regist_submission_status = !empty($request->input_status)? 100 : 0;
        $item->updated_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses menyimpan pengajuan');
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
