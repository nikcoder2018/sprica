<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Language;
use App\Http\Resources\Employee as ResourceEmployee;
use App\User;
use App\Role;
use App\Code;
use App\EmployeeCode;
use DataTables;
class EmployeesController extends Controller
{
    public function index(Request $request){
        $data['title'] = 'Employees';
        $data['roles'] = Role::all();
        return view('contents.employees.index', $data);
    }

    public function data(){
        $employees = User::with('debts')->get();
        return DataTables::of(ResourceEmployee::collection($employees))->toJson();
    }
    public function list(){
        $data['employees'] = User::with(['myrole','loans'])->where('status', 1)->orderBy('name', 'ASC')->get();
        $data['roles'] = Role::all();

        #return response()->json($data); exit;
        return view('admin.contents.employees-list', $data);
    }

    public function details($id){
        $data['roles'] = Role::all();
        $data['user_details'] = User::where('id', $id)->first();
        return view('admin.contents.employees-details', $data);
    }

    public function filters(Request $request){
        $employees = User::with('myrole')->orderBy('name', 'ASC');
        if($request->type != 'all'){
            switch($request->type){
                case 'admin': 
                    $role = Role::where('name', 'admin')->first();
                    $employees = $employees->where('role', $role->id);
                break;
                case 'employee': 
                    $role = Role::where('name', 'employee')->first();
                    $employees = $employees->where('role', $role->id);
                break;
            }
        }

        if($request->status != 'all'){
            switch($request->status){
                case 0: 
                    $employees = $employees->where('status', 0);
                break;
                
                case 1: 
                    $employees = $employees->where('status', 1);
                break;
                
            }
        }

        if($request->keyword){
            $keyword = $request->keyword;
            $employees = $employees->where('name', 'like', "%{$keyword}%");
        }

        
        $result = view('admin.contents.employees-listtable', ['employees' => $employees->get()])->render();

        return response()->json(array('result' => $result));
    }

    public function store(Request $request){
        $user = User::create([
            'name' => $request->display_name,  
            'username' => $request->username , 
            'password' => Hash::make($request->password), 
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
            'role' => $request->role,
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
        $user->role = $request->role;
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
            $message = "Account updated successfully.";
            return response()->json(array('success' => true, 'msg' => $message));
        }else{
            $message = "Something went wrong!";
            return response()->json(array('success' => false, 'msg' => $message));
        }
    }

    public function destroy(Request $request){
        $user = User::find($request->GunID);
        $user->delete();

        if($user){
            return response()->json(array('success' => true, 'msg' => 'User Deleted!'));
        }
    }
}
