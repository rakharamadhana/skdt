<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RegistSubmission;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;

use Validator;

class RegistApprovalController extends Controller
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
            (object) ['name' => 'Approval Regist as a Viewer or Presenter', 'link' => 'regist-approval']
        );

        return view('pages/regist-approval/common-list', compact('breadcrumb'));
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
        $list_data = RegistSubmission::with('created_by_user');

        if(!empty($request->filter)){
            $list_data = $list_data->whereIn('regist_submission_status', $request->filter);
        }
        
        if(!empty($request->input_by)){
            $list_data = $list_data->whereHas('created_by_user', function($q) use ($request){
                $q->where('user_status', $request->input_by);
            });
        }

        return Datatables::of($list_data)
                ->editColumn('gender', function($item){
                    return $item->genderToText();
                })
                ->addColumn('status', function($item){
                    return $item->statusToText();
                })
                ->addColumn('regist_submission_type', function($item){
                    return $item->typeToText();
                })
                ->addColumn('attendance_option', function($item){
                    return $item->attendanceToText();
                })
                ->addColumn('action', function($item){
                    $data = array(
                        'id' => $item->regist_submission_id,
                        'status' => $item->regist_submission_status,
                        'notes' => $item->notes,
                        'regist_submission_url' => $item->regist_submission_url,
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
            (object) ['name' => 'Approval Regist as a Viewer or Presenter', 'link' => 'regist-approval'],
            (object) ['name' => 'Tindakan', 'link' => 'regist-approval/'.$id.'/edit']
        );

        $item = RegistSubmission::findOrFail($id);

        return view('pages/regist-approval/manage-item', compact('breadcrumb', 'item'));
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
            'regist_submission_status' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $item = RegistSubmission::findOrFail($id);
        $item->regist_submission_status = $request->regist_submission_status;

        if($item->regist_submission_status == 2){
            $item->approval_at = now();
            $item->approval_by = auth_data()->user_id;

            if($request->hasFile('regist_submission_file')){
                $regist_submission_file = $request->file('regist_submission_file');
                
                $filename = pathinfo($regist_submission_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($regist_submission_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
           
                $path = $regist_submission_file->move(public_path('uploads'), $filename_new);
                $item->regist_submission_url = '/uploads/'.$filename_new;
            }
            $item->notes = '';

            $to_name = $item->created_by_user->fullname;
            $to_email = $item->created_by_user->email;
    
            $data = array(
                'name' => $item->fullname, 
                'regist_number' => $item->regist_submission_number
            );

            Mail::send('emails/accept-regist', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('PROFF OF PAYMENT');
                        $message->from(env('MAIL_FROM_ADDRESS', ''), env('MAIL_FROM_NAME', ''));
                    }
            );
        }else{
            $item->notes = $request->notes;
        }

        $item->updated_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses mengambil tindakan untuk Registrasi I3S '. $item->regist_submission_number);
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
