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
use Crypt;
use App\DataTables\UserDataTable;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        if(Auth::user()->can('user.create')){
            $users=User::all();
            return $dataTable->render('user.index');

        }
            return redirect('404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        if(Auth::user()->can('user.create')){
            return View('user.create');
        }
        return redirect('404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'userId' => 'required|string|max:255|unique:user,userId',
            'id_lokasi' => 'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
            'role'=>'required'
        ]);

        $foto=$request->file('foto');
        
        if($request->hasFile('foto')){
        $namafile=$foto->getClientOriginalName();
        Image::make($foto->getRealPath())->resize(215,215)->save('lib/img/' . $namafile);
        $image='lib/img/'.$namafile;    
        }else{
            $image=null;
        }

        $user=User::create([
            'userId'=>$request->input('userId'),
            'namaUser'=>$request->input('namaUser'),
            'password'=>bcrypt($request->input('password')),
            'id_lokasi'=>$request->input('id_lokasi'),
            'foto'=>$image
            ]);
        $user->assignRole($request->input('role'));

        return redirect()->route('user.index');
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
        $id=Crypt::decrypt($id);
        // $users=User::with('r_role')->where('userId','=',$id);
        $user=User::find($id);
        $usr=$user->r_role;
        foreach ($usr as $user_role) {
        $user_role=$user_role->namaRole;
        } 
        
        return view('user.edit',compact('user','user_role'));
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
            $user->id_lokasi=$request->input('id_lokasi');
            $user->save();
            $user->assignRole($role);
        }
        else{
            $user->userId=$request->input('userId');
            $user->namaUser=$request->input('namaUser');
            $user->password=bcrypt($request->input('password'));
            $user->id_lokasi=$request->input('id_lokasi');
            // $user->save();
            $user->assignRole($role);
        }

        return redirect()->route('user.index');
        
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
