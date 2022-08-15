<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CardRequest;
use Yajra\Datatables\Datatables;

use Validator;

class CardApprovalController extends Controller
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
            (object) ['name' => 'Approval Pengajuan KPIT', 'link' => 'card-approval']
        );

        return view('pages/card-approval/common-list', compact('breadcrumb'));
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
        $list_data = CardRequest::with('created_by_user');

        if(!empty($request->filter)){
            $list_data = $list_data->whereIn('card_status', $request->filter);
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
                ->addColumn('action', function($item){
                    $data = array(
                        'id' => $item->card_request_id,
                        'status' => $item->card_status,
                        'notes' => $item->notes,
                        'card_url' => $item->card_url,
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
            (object) ['name' => 'Approval Pengajuan KPIT', 'link' => 'card-approval'],
            (object) ['name' => 'Tindakan', 'link' => 'card-approval/'.$id.'/edit']
        );

        $item = CardRequest::findOrFail($id);

        return view('pages/card-approval/manage-item', compact('breadcrumb', 'item'));
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
            'card_status' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $item = CardRequest::findOrFail($id);
        $item->card_status = $request->card_status;

        if($item->card_status == 2){
            $item->approval_at = now();
            $item->approval_by = auth_data()->user_id;

            if($request->hasFile('card_file')){
                $card_file = $request->file('card_file');
                
                $filename = pathinfo($card_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($card_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
           
                $path = $card_file->move(public_path('uploads'), $filename_new);
                $item->card_url = '/uploads/'.$filename_new;
            }
            $item->notes = '';
        }else{
            $item->notes = $request->notes;
        }

        $item->updated_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses mengambil tindakan untuk KPIT '. $item->card_number);
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

    public function actionDownload(Request $request){

        $list_data = CardRequest::with('created_by_user');

        if(!empty($request->filter)){
            $list_data = $list_data->whereIn('card_status', $request->filter);
        }

        $list_data = $list_data->get();

        if(!empty($request->type) && $request->type == 'ktp'){
            $zip_file = 'ktp.zip';
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
    
            $data_ktp = $list_data->whereNotNull('attachment_id_card_url')->values()->all();
    
            foreach($data_ktp as $ktp){
                $ktp_file = $ktp->attachment_id_card_url;
                $ext = pathinfo($ktp_file, PATHINFO_EXTENSION);

                $zip->addFile(public_path($ktp_file), $ktp->fullname.'.'.$ext);
            }
        
            $zip->close();
            return response()->download($zip_file);
        }

        if(!empty($request->type) && $request->type == 'passport'){
            $zip_file = 'passport.zip';
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
    
            $data_passport = $list_data->whereNotNull('attachment_passport_url')->values()->all();
    
            foreach($data_passport as $passport){
                $passport_file = $passport->attachment_passport_url;
                $ext = pathinfo($passport_file, PATHINFO_EXTENSION);
    
                $zip->addFile(public_path($passport_file), $passport->fullname.'.'.$ext);
            }
        
            $zip->close();
            return response()->download($zip_file);
        }

        return view('pages/card-approval/download-excel', compact('list_data'));
    }
}
