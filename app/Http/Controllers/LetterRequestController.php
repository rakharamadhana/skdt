<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LetterCategory;
use App\Models\LetterRequest;
use Yajra\Datatables\Datatables;

use Validator;

class LetterRequestController extends Controller
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
            (object) ['name' => 'Pengajuan Surat', 'link' => 'letter-request']
        );

        if(auth_data()->user_status == 10) // Cabang
            return view('pages/letter-request/cabang/common-list', compact('breadcrumb'));
        else if(auth_data()->user_status == 11) // Internal
            return view('pages/letter-request/internal/common-list', compact('breadcrumb'));
        else if(auth_data()->user_status == 12) // Banom
            return view('pages/letter-request/banom/common-list', compact('breadcrumb'));
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
            (object) ['name' => 'Pengajuan Surat', 'link' => 'letter-request'],
            (object) ['name' => 'Ajukan Surat Baru', 'link' => 'letter-request/create']
        );
        
        $item = null;

        $letter_categories = LetterCategory::where('user_status', auth_data()->user_status)->orderBy('name', 'asc')->get();

        if(auth_data()->user_status == 10) // Cabang
            return view('pages/letter-request/cabang/manage-item', compact('breadcrumb', 'item', 'letter_categories'));
        else if(auth_data()->user_status == 11) // Internal
            return view('pages/letter-request/internal/manage-item', compact('breadcrumb', 'item', 'letter_categories'));
        else if(auth_data()->user_status == 12) // Banom
            return view('pages/letter-request/banom/manage-item', compact('breadcrumb', 'item', 'letter_categories'));
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

        $item = new LetterRequest;
        $item->letter_number = 'LA-'.time();
        $item->letter_category_id = $request->letter_category_id;
        $item->dept = $request->dept;
        $item->title = $request->title;
        $item->purpose = $request->purpose;
        $item->pic = $request->pic;
        $item->pic_contact = $request->pic_contact;
        
        $item->pic_email = !empty($request->pic_email)? $request->pic_email : null;
        $item->due_date = !empty($request->due_date)? $request->due_date : null;

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

        return success_response('Sukses menambah topik');
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $dt
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $dt = null)
    {
        $list_data = LetterRequest::with('letter_category')->byUser(auth_data()->user_id);

        if(!empty($request->filter)){
            $list_data = $list_data->whereIn('letter_status', $request->filter);
        }

        return Datatables::of($list_data)
                ->addColumn('letter_date', function($item){
                    if(!empty($item->start_date) && !empty($item->end_date)){
                        if($item->start_date == $item->end_date)
                            return date_format(date_create($item->start_date), 'd M Y');
                        else
                            return date_format(date_create($item->start_date), 'd M Y') . ' - '. date_format(date_create($item->end_date), 'd M Y');
                    }else{
                        return '';
                    }

                })
                ->addColumn('due_date', function($item){
                    if(!empty($item->due_date))
                        return date_format(date_create($item->due_date), 'd M Y');
                    else
                        return '';
                })
                ->addColumn('status', function($item){
                    return $item->statusToText();
                })
                ->addColumn('action', function($item){
                    $data = array(
                        'id' => $item->letter_request_id,
                        'status' => $item->letter_status,
                        'notes' => $item->notes,
                        'letter_url' => $item->letter_url,
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
            (object) ['name' => 'Pengajuan Surat', 'link' => 'letter-request'],
            (object) ['name' => 'Revisi dan Ajuan Kembali', 'link' => 'letter-request/'.$id.'/edit']
        );
        
        $item = LetterRequest::findOrFail($id);

        $letter_categories = LetterCategory::where('user_status', auth_data()->user_status)->orderBy('name', 'asc')->get();

        if(auth_data()->user_status == 10) // Cabang
            return view('pages/letter-request/cabang/manage-item', compact('breadcrumb', 'item', 'letter_categories'));
        else if(auth_data()->user_status == 11) // Internal
            return view('pages/letter-request/internal/manage-item', compact('breadcrumb', 'item', 'letter_categories'));
        else if(auth_data()->user_status == 12) // Banom
            return view('pages/letter-request/banom/manage-item', compact('breadcrumb', 'item', 'letter_categories'));
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

        $item = LetterRequest::findOrFail($id);
        $item->letter_category_id = $request->letter_category_id;
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

        $item->letter_status = 0;
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
