<?php

namespace App\Http\Controllers\Dashboard;

use Session;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }
    
	public function index()
	{
		$settings = Setting :: first();
		return view('dashboard.settings.index',[
			'settings' => $settings
		]);
	}
    public function update()
    {
    	$request = request();
    	//dd($request->all());
    	$this->validate($request, [
    		'site_name' => 'required',
    		'contact_number' => 'required',
    		'contact_email' => 'required',
    		'address' => 'required'
    	]);
    	// $params = $request->only(
    	// 	'site_name', 'contact_number', 'contact_email', 'address'
    	// );
    	$settings = Setting :: first();
    	//$settings->fill($params);
    	

    	// $settings->site_name = $request->site_name;
    	// $settings->contact_number = $request->contact_number;
    	// $settings->contact_email = $request->contact_email;
    	// $settings->address = $request->address;

    	//$settings->save();
    	$settings->update($request->all());
    	Session :: flash('success', 'Settings updated.');
    	return redirect()->back();
    }
}
