<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Models\Profile;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $users = User :: all();
        return view('dashboard.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
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
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $user = User :: create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('111')
        ]);
        $profile = Profile :: create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.jpg',
        ]);
        Session :: flash('success', 'New User added successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User :: find($id);
        if(Auth :: id() !== $user->id)
        {
            if(!empty($user->profile->avatar))
            { 
               unlink(public_path() . '/' . $user->profile->avatar); 
               if($user->profile->avatar !== NULL)
               { 
                    $user->profile->delete();
                    $user->delete();
               }
            }else{ 
                $user->profile->delete();
                $user->delete();
            } 
            Session :: flash('warning', 'User deleted.');
            return redirect()->back();
        }else{
            Session :: flash('danger', 'You don\'t want to delete yourself');
            return redirect()->back();
        } 
        
    }
    public function admin($id)
    {
        $user = User :: find($id);
        $user->admin = 1;
        $user->save();
        Session :: flash('info', 'Successfully change user permission');
        return redirect()->back();
    }
    public function member($id)
    {
        $user = User :: find($id);
        $user->admin = 0;
        $user->save();
        Session :: flash('info', 'Successfully change user permission');
        return redirect()->back();
    }
}
