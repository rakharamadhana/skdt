<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Submission;
use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Mail;
use Validator;

class SubmissionApprovalController extends Controller
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
            (object) ['name' => 'Approval Submission Paper I3S', 'link' => 'submission-approval']
        );

        return view('pages/submission-approval/common-list', compact('breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $dt
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $dt = null)
    {
        $list_data = Submission::with('created_by_user');

        if(!empty($request->filter)){
            $list_data = $list_data->whereIn('submission_status', $request->filter);
        }
        
        if(!empty($request->input_by)){
            $list_data = $list_data->whereHas('created_by_user', function($q) use ($request){
                $q->where('user_status', $request->input_by);
            });
        }

        return Datatables::of($list_data)
                ->addColumn('status', function($item){
                    return $item->statusToText();
                })
                ->addColumn('submission_purpose', function($item){
                    return $item->purposeToText();
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
            (object) ['name' => 'Approval Submission Paper I3S', 'link' => 'submission-approval'],
            (object) ['name' => 'Tindakan', 'link' => 'submission-approval/'.$id.'/edit']
        );

        $item = Submission::findOrFail($id);

        return view('pages/submission-approval/manage-item', compact('breadcrumb', 'item'));
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
            'submission_status' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $item = Submission::findOrFail($id);
        $item->submission_status = $request->submission_status;

        if($item->submission_status == 2){
            $item->approval_at = now();
            $item->approval_by = auth_data()->user_id;

            if($request->hasFile('submission_file')){
                $submission_file = $request->file('submission_file');
                
                $filename = pathinfo($submission_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($submission_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
           
                $path = $submission_file->move(public_path('uploads'), $filename_new);
                $item->submission_url = '/uploads/'.$filename_new;
            }
            $item->notes = '';

            $to_name = $item->created_by_user->fullname;
            $to_email = $item->created_by_user->email;
    
            $data = array(
                'name' => $item->fullname, 
                'title' => $item->title
            );
            
            Mail::send('emails/accept-submission', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('LETTER OF ABSTRACT ACCEPTANCE');
                        $message->from(env('MAIL_FROM_ADDRESS', ''), env('MAIL_FROM_NAME', ''));
                    }
            );
        }else{
            $item->notes = $request->notes;
        }

        $item->updated_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses mengambil tindakan untuk Submission Paper I3S '. $item->submission_number);
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
