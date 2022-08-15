<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LetterCategory;
use App\Models\LetterRequest;
use Yajra\Datatables\Datatables;

use Validator;

class LetterApprovalController extends Controller
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
            (object) ['name' => 'Approval Surat', 'link' => 'letter-approval']
        );

        return view('pages/letter-approval/common-list', compact('breadcrumb'));
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
        $list_data = LetterRequest::with('letter_category', 'created_by_user');

        if(!empty($request->filter)){
            $list_data = $list_data->whereIn('letter_status', $request->filter);
        }
        
        if(!empty($request->input_by)){
            $list_data = $list_data->whereHas('created_by_user', function($q) use ($request){
                $q->where('user_status', $request->input_by);
            });
        }

        return Datatables::of($list_data)
                ->addColumn('letter_date', function($item){
                    if($item->start_date == $item->end_date)
                        return date_format(date_create($item->start_date), 'd M Y');
                    else
                        return date_format(date_create($item->start_date), 'd M Y') . ' - '. date_format(date_create($item->end_date), 'd M Y');
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
            (object) ['name' => 'Approval Surat', 'link' => 'letter-approval'],
            (object) ['name' => 'Tindakan', 'link' => 'letter-approval/'.$id.'/edit']
        );

        $item = LetterRequest::findOrFail($id);

        $letter_categories = LetterCategory::orderBy('name', 'asc')->get();

        return view('pages/letter-approval/manage-item', compact('breadcrumb', 'item', 'letter_categories'));
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
            'letter_status' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $item = LetterRequest::findOrFail($id);
        $item->letter_status = $request->letter_status;

        if($item->letter_status == 2){
            $item->approval_at = now();
            $item->approval_by = auth_data()->user_id;

            if($request->hasFile('letter_file')){
                $letter_file = $request->file('letter_file');
                
                $filename = pathinfo($letter_file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = pathinfo($letter_file->getClientOriginalName(), PATHINFO_EXTENSION);
        
                $filename_new = time().'_'.$filename.'.'.$ext;
           
                $path = $letter_file->move(public_path('uploads'), $filename_new);
                $item->letter_url = '/uploads/'.$filename_new;
            }
            $item->notes = '';
        }else{
            $item->notes = $request->notes;
        }

        $item->updated_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses mengambil tindakan untuk surat '. $item->letter_number);
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
