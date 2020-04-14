<?php

namespace App\Http\Controllers\Dashboard;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Auth :: user();
        return view('dashboard.users.profile', [
            'user' => $profile
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'facebook' => 'required|url',
            'youtube' => 'required|url'
        ]); 
        $user = Auth :: user(); 
        if($request->has('password')):
            $user->password = bcrypt($request->password);
            $user->save();
        endif;  
        
        if($request->hasFile('avatar')):
            $avatar = $request->avatar;
            $newAvatar = time() . $avatar->getClientOriginalName();
            $avatar_path = 'uploads/avatars/';
            $avatar->move($avatar_path, $newAvatar);
            $user->profile->avatar = $avatar_path . $newAvatar;
            $user->profile->save();
        endif;   
        $user->name = $request->name; 
        $user->email = $request->email; 
        $user->profile->facebook = $request->facebook;
        $user->profile->youtube = $request->youtube;
        $user->profile->about = $request->about;
        $user->save();
        $user->profile->save();
        // if($request->has('password')):
        //     $user->password = bcrypt($request->password);
        //     $user->save();
        // endif;
        Session :: flash('success', 'Your Profile was Updated Successfully.');
        return redirect()->back();
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
}
