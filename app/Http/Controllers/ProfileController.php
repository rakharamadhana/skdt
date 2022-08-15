<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

class ProfileController extends Controller
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
            (object) ['name' => 'Edit Profil', 'link' => 'profile']
        );

        return view('pages/profile', compact('breadcrumb'));
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
            'year_entries' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
        ]);


        if($validator->fails()) {
            return error_response($validator->errors()->first());
        }

        $user = auth_data();

        $user->fullname = $request->fullname;
        $user->year_entries = $request->year_entries;
        $user->gender = $request->gender;
        $user->nationality = $request->nationality;
        $user->citizen_id_card = $request->citizen_id_card;
        $user->birthplace = $request->birthplace;
        $user->birthplace = $request->birthplace;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return success_response('Sukses mengubah profil');
    }
}
