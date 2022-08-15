<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CertRequest;
use Yajra\Datatables\Datatables;

use Validator;

class CertRequestController extends Controller
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
            (object) ['name' => 'Pengajuan Sertifikat', 'link' => 'cert-request']
        );

        if(auth_data()->user_status == 10) // Cabang
            return view('pages/cert-request/cabang/common-list', compact('breadcrumb'));
        else
            return view('pages/cert-request/internal/common-list', compact('breadcrumb'));
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
            (object) ['name' => 'Pengajuan Sertifikat', 'link' => 'cert-request'],
            (object) ['name' => 'Ajukan Sertifikat Baru', 'link' => 'cert-request/create']
        );
        
        $item = null;

        if(auth_data()->user_status == 10) // Cabang
            return view('pages/cert-request/cabang/manage-item', compact('breadcrumb', 'item'));
        else
            return view('pages/cert-request/internal/manage-item', compact('breadcrumb', 'item'));
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
            'pic' => 'required',
            'pic_contact' => 'required',
            'title' => 'required',
            'purpose' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $item = new CertRequest;
        $item->cert_number = 'CT-'.time();
        $item->pic = $request->pic;
        $item->pic_contact = $request->pic_contact;
        $item->title = $request->title;
        $item->purpose = $request->purpose;

        $item->dept = !empty($request->dept)? $request->dept : null;
        $item->start_date = !empty($request->start_date)? $request->start_date : null;
        $item->end_date = !empty($request->end_date)? $request->end_date : null;

        if($request->hasFile('attachment_file')){
            $attachment_file = $request->file('attachment_file');
            
            $filename = pathinfo($attachment_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($attachment_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $attachment_file->move(public_path('uploads'), $filename_new);
            $item->support_file = '/uploads/'.$filename_new;
        }

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
        $list_data = CertRequest::byUser(auth_data()->user_id);
        
        if(!empty($request->filter)){
            $list_data = $list_data->whereIn('cert_status', $request->filter);
        }

        return Datatables::of($list_data)
                ->addColumn('cert_date', function($item){
                    if(!empty($item->start_date) && !empty($item->end_date)){
                        if($item->start_date == $item->end_date)
                            return date_format(date_create($item->start_date), 'd M Y');
                        else
                            return date_format(date_create($item->start_date), 'd M Y') . ' - '. date_format(date_create($item->end_date), 'd M Y');
                    }else{
                        return '';
                    }
                })
                ->addColumn('status', function($item){
                    return $item->statusToText();
                })
                ->addColumn('action', function($item){
                    $data = array(
                        'id' => $item->cert_request_id,
                        'status' => $item->cert_status,
                        'notes' => $item->notes,
                        'cert_url' => $item->cert_url,
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
            (object) ['name' => 'Pengajuan Sertifikat', 'link' => 'cert-request'],
            (object) ['name' => 'Revisi dan Ajuan Kembali', 'link' => 'cert-request/'.$id.'/edit']
        );
        
        $item = CertRequest::findOrFail($id);

        if(auth_data()->user_status == 10) // Cabang
            return view('pages/cert-request/cabang/manage-item', compact('breadcrumb', 'item'));
        else
            return view('pages/cert-request/internal/manage-item', compact('breadcrumb', 'item'));
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
            'dept' => 'required',
            'pic' => 'required',
            'pic_contact' => 'required',
            'title' => 'required',
            'purpose' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $item = CertRequest::findOrFail($id);
        $item->dept = $request->dept;
        $item->pic = $request->pic;
        $item->pic_contact = $request->pic_contact;
        $item->title = $request->title;
        $item->purpose = $request->purpose;
        $item->start_date = $request->start_date;
        $item->end_date = $request->end_date;

        if($request->hasFile('attachment_file')){
            $attachment_file = $request->file('attachment_file');
            
            $filename = pathinfo($attachment_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($attachment_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $attachment_file->move(public_path('uploads'), $filename_new);
            $item->support_file = '/uploads/'.$filename_new;
        }

        $item->cert_status = 0;
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
