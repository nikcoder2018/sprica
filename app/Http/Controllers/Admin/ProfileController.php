<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Code;
use App\EmployeeCode;

class ProfileController extends Controller
{
    public function index(){
        $data['roles'] = Role::all();
        $data['user_details'] = User::where('id', auth()->user()->id)->first();
        return view('admin.contents.profile', $data);
    }

    public function update(Request $request){

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->number = $request->number;
        if($request->password != '' || $request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->department = $request->department; 
        $user->hour_fee = $request->hour_fee;
        $user->tax_status = $request->tax_status;
        $user->login_date = $request->login_date;
        $user->day_off = $request->day_off;
        $user->street = $request->street;
        $user->postal_code = $request->postal_code;
        $user->date_of_birth = $request->date_of_birth;
        $user->place_of_birth = $request->place_of_birth;
        $user->nationality = $request->nationality;
        $user->sg_number = $request->sg_number;
        $user->health_insurance = $request->health_insurance;
        $user->exit = $request->exit;
        $user->function = $request->function;
        $user->STIDNUM = $request->STIDNUM;
        $user->driving_license = $request->driving_license; 
        $user->vds_identity = $request->vds_identity;
        $user->bank_connection = $request->bank_connection;
        $user->bank = $request->bank; 
        $user->IBAN = $request->IBAN;
        $user->BIC = $request->BIC;
        $user->status = $request->status;
        $user->save();

        if($request->codes){
            $newCodes = array();
            foreach($request->codes as $code){
                array_push($newCodes, $code);
                if(Code::where('KodID', $code)->exists() ){
                    if(!EmployeeCode::where('PersonelID', $user->id)->where('KodID', $code)->exists()){
                        EmployeeCode::create([
                            'PersonelID' => $user->id, 
                            'KodID' => $code
                        ]);
                    }
                }
            }
            EmployeeCode::where('PersonelID', $user->id)->whereNotIn('KodID', $newCodes)->delete();
        }

        if($user){
            $message = "Profile updated successfully.";
            return response()->json(array('success' => true, 'msg' => $message));
        }else{
            $message = "Something went wrong!";
            return response()->json(array('success' => false, 'msg' => $message));
        }
    }
}
