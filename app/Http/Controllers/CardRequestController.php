<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LetterCategory;
use App\Models\CardRequest;
use Yajra\Datatables\Datatables;

use Validator;

class CardRequestController extends Controller
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
            (object) ['name' => 'Apply Kartu Pelajar Indonesia', 'link' => 'card-request']
        );

        $list_data = CardRequest::byUser(auth_data()->user_id)->get();

        return view('pages/card-request/common-list', compact('breadcrumb', 'list_data'));
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
            (object) ['name' => 'Apply Kartu Pelajar Indonesia', 'link' => 'card-request'],
            (object) ['name' => 'Pengajuan', 'link' => 'card-request/create']
        );
        
        $item = null;

        return view('pages/card-request/manage-item', compact('breadcrumb', 'item'));
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

        $item = new CardRequest;
        $item->card_number = 'CD-'.time();

        $item->fullname = strtoupper($request->fullname);
        $item->gender = $request->gender;
        $item->passport = strtoupper($request->passport);
        $item->passport_date = !empty($request->passport_date)? strtoupper($request->passport_date) : null;
        $item->citizen_id_card = strtoupper($request->citizen_id_card);
        $item->birth_place = strtoupper($request->birth_place);
        $item->birthday = !empty($request->birthday)? strtoupper($request->birthday) : null;
        $item->religion = strtoupper($request->religion);
        $item->relation_status = strtoupper($request->relation_status);
        $item->last_education = strtoupper($request->last_education);
        $item->mother_name = strtoupper($request->mother_name);
        $item->address_id = strtoupper($request->address_id);
        $item->phone_id = strtoupper($request->phone_id);
        $item->phone_tw = strtoupper($request->phone_tw);
        $item->address_tw_en = strtoupper($request->address_tw_en);
        $item->address_tw_cn = strtoupper($request->address_tw_cn);
        $item->phone = strtoupper($request->phone);
        $item->line_id = $request->line_id;
        $item->degree = strtoupper($request->degree);
        $item->prodi = strtoupper($request->prodi);
        $item->university = strtoupper($request->university);
        $item->year_and_term = strtoupper($request->year_and_term);
        $item->is_bni = $request->is_bni;
        $item->want_bni = $request->want_bni;
        $item->want_bni_bank = $request->want_bni_bank;

        if($request->hasFile('attachment_id_card_file')){
            $attachment_id_card_file = $request->file('attachment_id_card_file');
            
            $filename = pathinfo($attachment_id_card_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($attachment_id_card_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $attachment_id_card_file->move(public_path('uploads'), $filename_new);
            $item->attachment_id_card_url = '/uploads/'.$filename_new;
        }

        if($request->hasFile('attachment_passport_file')){
            $attachment_passport_file = $request->file('attachment_passport_file');
            
            $filename = pathinfo($attachment_passport_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($attachment_passport_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $attachment_passport_file->move(public_path('uploads'), $filename_new);
            $item->attachment_passport_url = '/uploads/'.$filename_new;
        }
        
        if(empty($item->attachment_id_card_url) && empty($item->attachment_passport_url)){
            $request->input_status = 100;
        }

        $item->card_status = !empty($request->input_status)? 100 : 0;

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
        $item = CardRequest::findOrFail($id);

        if($item->card_status == 1){
            $breadcrumb_item = (object) ['name' => 'Revisi dan Ajuan Kembali', 'link' => 'card-request/'.$id.'/edit'];
        }else{
            $breadcrumb_item = (object) ['name' => 'Pengajuan', 'link' => 'card-request/'.$id.'/edit'];
        }

        $breadcrumb = array(
            (object) ['name' => 'Dashboard', 'link' => 'welcome'],
            (object) ['name' => 'Apply Kartu Pelajar Indonesia', 'link' => 'card-request'],
            $breadcrumb_item
        );

        return view('pages/card-request/manage-item', compact('breadcrumb', 'item'));
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

        $item = CardRequest::findOrFail($id);
        $item->fullname = $request->fullname;
        $item->gender = $request->gender;
        $item->passport = $request->passport;
        $item->passport_date = $request->passport_date;
        $item->citizen_id_card = $request->citizen_id_card;
        $item->birth_place = $request->birth_place;
        $item->birthday = $request->birthday;
        $item->religion = $request->religion;
        $item->relation_status = $request->relation_status;
        $item->last_education = $request->last_education;
        $item->mother_name = $request->mother_name;
        $item->address_id = $request->address_id;
        $item->phone_id = $request->phone_id;
        $item->phone_tw = $request->phone_tw;
        $item->address_tw_en = $request->address_tw_en;
        $item->address_tw_cn = $request->address_tw_cn;
        $item->phone = $request->phone;
        $item->line_id = $request->line_id;
        $item->degree = $request->degree;
        $item->prodi = $request->prodi;
        $item->university = $request->university;
        $item->year_and_term = $request->year_and_term;
        $item->is_bni = $request->is_bni;
        $item->want_bni = $request->want_bni;
        $item->want_bni_bank = $request->want_bni_bank;

        if($request->hasFile('attachment_id_card_file')){
            $attachment_id_card_file = $request->file('attachment_id_card_file');
            
            $filename = pathinfo($attachment_id_card_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($attachment_id_card_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $attachment_id_card_file->move(public_path('uploads'), $filename_new);
            $item->attachment_id_card_url = '/uploads/'.$filename_new;
        }

        if($request->hasFile('attachment_passport_file')){
            $attachment_passport_file = $request->file('attachment_passport_file');
            
            $filename = pathinfo($attachment_passport_file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = pathinfo($attachment_passport_file->getClientOriginalName(), PATHINFO_EXTENSION);
    
            $filename_new = time().'_'.$filename.'.'.$ext;
       
            $path = $attachment_passport_file->move(public_path('uploads'), $filename_new);
            $item->attachment_passport_url = '/uploads/'.$filename_new;
        }

        if(empty($item->attachment_id_card_url) && empty($item->attachment_passport_url)){
            $request->input_status = 100;
        }

        $item->card_status = !empty($request->input_status)? 100 : 0;
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
