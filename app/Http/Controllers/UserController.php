<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Yajra\Datatables\Datatables;

use Validator;

class UserController extends Controller
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
            (object) ['name' => 'Daftar Anggota', 'link' => 'user']
        );

        return view('pages/user/common-list', compact('breadcrumb'));
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
            (object) ['name' => 'Daftar Anggota', 'link' => 'user'],
            (object) ['name' => 'Tambah Anggota', 'link' => 'user/create']
        );
        
        $item = null;

        return view('pages/user/manage-item', compact('breadcrumb', 'item'));
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
            'fullname' => 'required',
            'email' => 'required',
            'user_status' => 'required',
        ]);


        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $item = new User;
        $item->fullname = $request->fullname;
        $item->user_status = $request->user_status;
        $item->email = $request->email;
        $item->username = $item->email;

        $item->created_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses menambah anggota');
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $dt
     * @return \Illuminate\Http\Response
     */
    public function show($dt = null)
    {
        $list_data = User::select('*')->where('user_status', '<>', 1);

        return Datatables::of($list_data)
                ->addColumn('status', function($item){
                    return $item->statusToText();
                })
                ->addColumn('action', function($item){
                    $data = array(
                        'id' => $item->user_id
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
            (object) ['name' => 'Daftar Anggota', 'link' => 'user'],
            (object) ['name' => 'Edit Anggota', 'link' => 'user/'.$id.'/edit']
        );

        $item = User::findOrFail($id);

        return view('pages/user/manage-item', compact('breadcrumb', 'item'));
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
            'fullname' => 'required',
            'email' => 'required',
            'user_status' => 'required',
        ]);

        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $item = User::findOrFail($id);
        $item->fullname = $request->fullname;
        $item->user_status = $request->user_status;
        $item->email = $request->email;
        $item->username = $item->email;

        $item->updated_by = auth_data()->user_id;
        $item->save();

        return success_response('Sukses mengedit anggota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return success_response('Sukses menghapus anggota');
    }

    public function indexUserPassword($id)
    {
        $item = User::findOrFail($id);

        return view('pages/user/password-item', compact('item'));
    }

    public function actionUserPassword(Request $request, $id){
        if($request->new_password == $request->new_confirm_password){
            $user = User::findOrFail($id);

            $user->password = Hash::make($request->new_password);
            $user->save();

            return success_response('Sukses mengganti password');
        }else{
            return error_response('Ketikkan lagi password baru');
        }
    }
}
