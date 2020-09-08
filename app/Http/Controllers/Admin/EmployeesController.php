<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Language;

use App\User;
use App\Role;
use App\Code;
use App\EmployeeCode;

class EmployeesController extends Controller
{
    public function index(Request $request){
        $role = Role::where('name', 'employee')->first();
        $data['employees'] = User::all();
        $data['roles'] = Role::all();

        if($request->get('id') != ''){
            $data['user_details'] = User::where('id', $request->get('id'))->first();
        }

        return view('admin.contents.employees', $data);
    }

    public function list(){
        $role = Role::where('name', 'employee')->first();
        $data['employees'] = User::where('role', $role->id)->get();

        $data['roles'] = Role::all();
        return view('admin.contents.employees-list', $data);
    }

    public function store(Request $request){
        $user = User::create([
            'display_name' => $request->display_name,  
            'username' => $request->username , 
            'password' => $request->password , 
            'number' => $request->number , 
            'department' => $request->department , 
            'hour_fee' => $request->hour_fee , 
            'tax_status' => $request->tax_status , 
            'login_date' => $request->login_date , 
            'day_off' => $request->day_off , 
            'street' => $request->street , 
            'postal_code' => $request->postal_code , 
            'date_of_birth' => $request->date_of_birth , 
            'place_of_birth' => $request->place_of_birth , 
            'nationality' => $request->nationality , 
            'sg_number' => $request->sg_number , 
            'health_insurance' => $request->health_insurance , 
            'exit' => $request->exit , 
            'function' => $request->function , 
            'STIDNUM' => $request->STIDNUM , 
            'driving_license' => $request->driving_license , 
            'vds_identity' => $request->vds_identity , 
            'bank_connection' => $request->bank_connection , 
            'bank' => $request->bank , 
            'IBAN' => $request->IBAN , 
            'BIC' => $request->BIC , 
            'role' => $request->role 
        ]);
        
        if($request->codes){
            foreach($request->codes as $code=>$value){
                if(Code::where('Kod', $code)->first()){
                    EmployeeCode::create([
                        'PersonelID' => $user->id, 
                        'KodID' => $code
                    ]);
                }
            }
        }

        if($user){
            $message = "New account added successfully.";
            return response()->json(array('success' => true, 'msg' => $message));
        }else{
            $message = "Something went wrong!";
            return response()->json(array('success' => false, 'msg' => $message));
        }
    }

    public function edit(Request $request){
        $data['user'] = User::where('id', $request->id)->first();
        $data['codes'] = EmployeeCode::where('PersonelID',$request->id)->get();

        return response()->json($data);
    }

    public function update(Request $request){

        $user = User::find($request->id);
        $user->display_name = $request->display_name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->number = $request->number;
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
        $user->role = $request->role;
        $user->save();

        if($user){
            $message = "Account updated successfully.";
            return response()->json(array('success' => true, 'msg' => $message));
        }else{
            $message = "Something went wrong!";
            return response()->json(array('success' => false, 'msg' => $message));
        }
    }
}
