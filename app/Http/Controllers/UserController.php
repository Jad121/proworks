<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ws_user;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class UserController extends Controller
{


    public function getAll()
    {
        $user = ws_user::all();
        return response()->json($user);
    }


    public function form()
    {

        $user = [];
        $action = request()->has('id') ? 'update' : 'add';
        if(request()->has('id')){
            $user = ws_user::find(request()->id)->toArray();
        }
        return view('User.form', compact('user', 'action'));

       
    }


    public function list()
    {
        return view('User.list');
    }

  
    public function getAllCountries()
    {
        $countries = Country::all(); 
        return response()->json($countries);
    }

    public function addRecord(Request $request)
    {
       
        $user =   $request->validate([
            'ws_user_fname' => 'required',
            'ws_user_lname' => 'required',

            //add more later
        ]);

        // $user["pass"]=Hash::make($user["pass"]);
        // $user["create_by"]=auth()->user()->ws_user_id,
        // $user["time"]=Hash::make($user["pass"]);


        ws_user::create([
            'ws_user_first_name' => $request->ws_user_fname,
            'ws_user_last_name' => $request->ws_user_lname,
            'ws_user_email' => $request->ws_user_email,
            'ws_user_address' => $request->ws_user_address,
            'ws_user_phone' => $request->ws_user_phone,
            'ws_user_created_by' => auth()->user()->ws_user_id,
            'ws_country_id' => $request->countryDropdown,
            'ws_user_password' => Hash::make($request->ws_user_password)
        ]);
        return response()->json([
            "status" => "success",
            'message' => 'Record added successfully'
        ]);
    }

    public function updateRecord(Request $request, $recordId)
    {
        $request->validate([
            'ws_user_fname' => 'required',
            'ws_user_lname' => 'required'
            //add more later
        ]);
        ws_user::where('ws_user_id', $recordId)->update([
            'ws_user_first_name' => $request->ws_user_fname,
            'ws_user_last_name' => $request->ws_user_lname,
            'ws_user_email' => $request->ws_user_email,
            'ws_user_address' => $request->ws_user_address,
            'ws_user_phone' => $request->ws_user_phone,
            'ws_user_created_by' => auth()->user()->ws_user_id,
            'ws_user_updated_by' => auth()->user()->ws_user_id,
            'ws_country_id' => $request->countryDropdown,
            'ws_user_password' => Hash::make($request->ws_user_password),
            'ws_user_updated_date' => Carbon::now()->toDateTimeString(),
        ]);
        return response()->json(['message' => 'Record Updated successfully','status'=>'success']);
    }

    public function deleteRecord(Request $request){
        ws_user::where('ws_user_id',$request->userId)->delete();
        return response()->json(['message'=>'User Deleted Successfuly','status'=>'success']);
    }
}
