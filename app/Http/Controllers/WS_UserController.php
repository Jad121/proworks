<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ws_user;
use App\Models\WS_Country;
use Illuminate\Support\Facades\Hash;

class WS_UserController extends Controller
{
    public function index(){
        return view('User.list');
    }

    public function getAll(){
        $user=ws_user::all();
        return response()->json($user);
    }
  
    public function getAllCountries()
    {
        $countries = WS_Country::all(); // Replace with your model and data source
        return response()->json($countries);
    }
    
    public function addRecord(Request $request){
        $request->validate([
            'ws_user_fname'=>'required',
            'ws_user_lname'=>'required'
            //add more later
        ]);
        ws_user::create([
            'ws_user_first_name'=>$request->ws_user_fname,
            'ws_user_last_name'=>$request->ws_user_lname,
            'ws_user_email'=>$request->ws_user_email,
            'ws_user_address'=>$request->ws_user_address,
            'ws_user_phone'=>$request->ws_user_phone,
            'ws_user_created_by'=>auth()->user()->ws_user_id,
            'ws_country_id'=>$request->countryDropdown,
            'ws_user_password'=>Hash::make($request->ws_user_password)
        ]);
        return response()->json(['message' => 'Record added successfully']);
    }

    public function updateRecord(Request $request,$recordId){
        $request->validate([
            'ws_user_fname'=>'required',
            'ws_user_lname'=>'required'
            //add more later
        ]);
        ws_user::where('ws_user_id',$recordId)->update([
            'ws_user_first_name'=>$request->ws_user_fname,
            'ws_user_last_name'=>$request->ws_user_lname,
            'ws_user_email'=>$request->ws_user_email,
            'ws_user_address'=>$request->ws_user_address,
            'ws_user_phone'=>$request->ws_user_phone,
            'ws_user_created_by'=>auth()->user()->ws_user_id,
            'ws_user_updated_by'=>auth()->user()->ws_user_id,
            'ws_country_id'=>$request->countryDropdown,
            'ws_user_password'=>Hash::make($request->ws_user_password)
        ]);
        return response()->json(['message' => 'Record added successfully']);
    }
}
