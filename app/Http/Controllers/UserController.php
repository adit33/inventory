<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\User;
use Session;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return View('user.create',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        return View('user.create',['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($data = $request->all(),User::$rules);
        if ($validator->fails())
        {
            return response()->Json(array('errors'=>$validator->errors()->toArray()));
        }

        $foto=$request->file('foto');
        $namafile=$foto->getClientOriginalName();
        Image::make($foto->getRealPath())->resize(215,215)->save('lib/img/' . $namafile);
        $image='lib/img/'.$namafile;
        $user=User::create([
            'userId'=>$request->input('userId'),
            'namaUser'=>$request->input('namaUser'),
            'password'=>bcrypt($request->input('password')),
            'foto'=>$image
            ]);
        $user->assignRole($request->input('role'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$users=User::with('r_role')->where('id','=',$id);
        $user=User::find($id);
        foreach($user->r_role as $users)
        $data=[
            'users'=>$users,
            'user'=>$user
        ];
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user=User::find($id);

        $rules = [
                'userId'=>'required|unique:user,userId,'.$id.',userId',
                'password'=>'required|between:4,10|confirmed',
                'password_confirmation'=>'required|between:4,10'
                ];

         $validator = Validator::make($data = $request->all(),$rules);
        if ($validator->fails())
        {
            return response()->Json(array('errors'=>$validator->errors()->toArray()));
        }

        $foto=$request->file('foto');
        
        $role=$request->input('role');
        $user->revokeRole($user->role);
        if(!empty($foto)){
            $namafile=$foto->getClientOriginalName();
            Image::make($foto->getRealPath())->resize(215,215)->save('lib/img/' . $namafile);
            $image='lib/img/'.$namafile;
            $user->foto=$image;
            $user->revokeRole($role);
            $user->userId=$request->input('userId');
            $user->namaUser=$request->input('namaUser');
            $user->password=bcrypt($request->input('password'));
            $user->save();
            $user->assignRole($role);
        }
        else{
            $user->userId=$request->input('userId');
            $user->namaUser=$request->input('namaUser');
            $user->password=bcrypt($request->input('password'));
            // $user->save();
            $user->assignRole($role);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(){
        return View('layout.login');
    }

    public function doLogin(Request $request)
    {
        
        $rules = array(
                        'userId'    => 'required',
                        'password' => 'required|alphaNum|min:4'
        );

        $pesan = array(
                        'userId.required'    => 'username harus di isi',
                        'password.required' => 'password harus di isi'
        );
        $validator = Validator::make($request->all(), $rules,$pesan);
        if ($validator->fails()) {
                        return redirect('login')
                                        ->withErrors($validator)
                                        ->withInput($request->except('password'));
        } 
        
        else {
                        $userdata = array(
                                        'userId'       => $request->input('userId'),
                                        'password'  => $request->input('password')
                        );

                        if (Auth::attempt($userdata)) {
                                        return redirect('/barang')->with('successMessage','Selamat Datang '.Auth::user()->nama);
                        } else {               
                                        return redirect('login')->with('errorMessage','Username dan Password tidak cocok');
                        }
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect('/login')->with('successMessage','Anda berhasil Logout');
    }

}
