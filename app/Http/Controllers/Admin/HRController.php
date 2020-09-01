<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Language;
use App\Watches;
use App\Members;
use App\RemainingPayment;
use App\AdvancePayment;
use App\Role;
use App\Project;
use App\Code;

use Carbon\Carbon;

class HRController extends Controller
{
    //
    public function control(Request $request){
        $role = Role::where('name', 'employee')->first();

        $data['text'] = array(
            'page_title' => Language::settings('Admin_Kontrol'),
            'select_employees' => Language::settings('Isci_Seciniz'),
            'date_from' => Language::settings('Baslangic_Tarihi_Seciniz'),
            'date_end' => Language::settings('Bitis_Tarihi_Seciniz'),
            'checked' => Language::settings('Onay_Durumu'),
            'not_checked' => Language::settings('Onaysizlari_Goster'),
            'verified' => Language::settings('Onaylilari_Goster'),
            'all' => Language::settings('Tumunu_Goster')
        );

        $data['total_confirmations'] = Watches::sum('Onay');
        $data['all_members'] = Members::where('role', $role->id)->orderBy('display_name', 'ASC')->get();
        $data['projects'] = Project::orderBy('projeKODU', 'ASC')->get();
        $data['codes'] = Code::orderBy('Kod', 'ASC')->get();
        $data['table_data'] = array();
        $data['table_data_saat'] = 0;
        if($request->UyeID){
            $query = Watches::where('UyeID', $request->UyeID);

            if($request->TarihBAS)
                $query = $query->where('Tarih', '>=', $request->TarihBAS);
            if($request->TarihBIT)
                $query =  $query->where('Tarih', '<=', $request->TarihBIT);
            
            if($request->Onay){
                switch($request->Onay){
                    case 1: 
                        $query = $query->where('Onay', 0);
                    break;
    
                    case 3:
                        $query = $query->where('Onay', 1);
                    break;
                }
            }
            $data['table_data'] = $query->get();
            $data['table_data_saat'] = $query->sum('Saat');
        }
        #return response()->json($data);
        return view('admin.contents.control', $data);
    }

    public function control_addtime(Request $request){
        $saat = $request->Saat; 
        $code = $request->Kod; 

        if($request->ProjeID == 1 || $request->ProjeID == 2){
            $saat = 8;
            $kod = 12;
        }

        $time = Watches::create([
            'UyeID' => $request->UyeID,
            'ProjeID' => $request->ProjeID,
            'ProjeBASLIK' => $request->ProjeBASLIK,
            'Tarih' => $request->Tarih,
            'Saat' => $saat,
            'Onay' => 0,
            'Odenecek' => 0,
            'Gunduz' => $request->Gunduz,
            'Kod' => $code,
            'Calisti' => 0
        ]);

        if($time){
            return response()->json(array('success' => true, 'msg' => 'New Time Added'));
        }else{
            return response()->json(array('success' => false, 'msg' => 'Something went wrong!'));
        }    
    }

    public function control_edittime(Request $request){
        $time = Watches::where('SaatID', $request->SaatID)->first();
        return response()->json($time);
    }

    public function control_updatetime(Request $request){
        $time = Watches::where('SaatID', $request->SaatID)->first();
        $time->ProjeID = $request->ProjeID;
        $time->ProjeBASLIK = $request->ProjeBASLIK;
        $time->Gunduz = $request->Gunduz;
        $time->Saat = $request->Saat;
        $time->Tarih = $request->Tarih;
        $time->save();

        if($time){
            return response()->json(array('success' => true, 'msg' => 'Time Updated'));
        }else{
            return response()->json(array('success' => false, 'msg' => 'Something went wrong!'));
        }   
    }

    public function control_confirmall(Request $request){
        if($request->SilID){
            foreach($request->SilID as $id){
                $time = Watches::find($id);
                $time->Onay = 1;
                $time->save();
            }
        }

        return response()->json(array('success' => 1));
    }

    public function wages(Request $request){
        $role = Role::where('name', 'employee')->first();
        $data['text'] = array(
            'page_title' => Language::settings('Admin_Kontrol'),
            'select_employees' => Language::settings('Isci_Seciniz'),
        );

        $data['all_members'] = Members::where('role', $role->id)->orderBy('display_name', 'ASC')->get();
        $year_first = Carbon::create(Carbon::now()->year, 1,1)->toDateString();
       
        if($request->UyeID){
            $year_first = Carbon::create(Carbon::now()->year, 1,1)->toDateString();
            
            $data['profile'] = Members::where('id', $request->UyeID)->first();
            $data['vacation'] = Watches::where('Tarih', '>=', $year_first)->where('Onay', 1)->where('ProjeID', 1)->where('UyeID', $request->UyeID)->count();
            
            $sq = Watches::where('Tarih', '>=', $year_first);
            if($request->Ay){
                $end_of_month = Carbon::create(Carbon::now()->year, $request->Ay,1)->endOfMonth()->toDateString();
                $sq->where('Tarih', '<=', $end_of_month)->where('Onay', 1)->where('ProjeID', 1)->where('UyeID', $request->UyeID);
            }
            $data['sick'] = $sq->count();

            
            $current_month = Watches::where('Onay', 1)->where('UyeID', $request->UyeID);
            $current_month_kug = Watches::where('Onay', 1)->where('UyeID', $request->UyeID)->where('ProjeID', 10);
            if($request->Yil && $request->Ay){
                $first_of_month = Carbon::create($request->Yil, $request->Ay,1);
                $end_of_month = Carbon::create($request->Yil, $request->Ay,1)->endOfMonth()->toDateString();
                $current_month = $current_month->where('Tarih', '>=', $first_of_month)->where('Tarih', '<=', $end_of_month);
                $current_month_kug = $current_month_kug->where('Tarih', '>=', $first_of_month)->where('Tarih', '<=', $end_of_month);
            }  

            $paid_out = RemainingPayment::where('UyeID', $request->UyeID);
            if($request->Yil){
                $paid_out = $paid_out->where('Yil', $request->Yil);
            }    
            if($request->Ay){
                $paid_out = $paid_out->where('Ay', $request->Ay);
            }

            $data['paid_hours'] = array(
                'current_month' => $current_month->sum('Saat'),
                'paid_out' => $paid_out->sum('KalanODEME'),
                'good_hours' => Watches::where('UyeID', $request->UyeID)->where('Onay', 1)->sum('Saat') - RemainingPayment::where('UyeID', $request->UyeID)->sum('KalanODEME'),
                'current_month_kug' => $current_month_kug->sum('saat')
            );

        }

        #return response()->json($data);
        return view('admin.contents.wages', $data);
    }

    public function wages_total(Request $request){
        $data['all_members'] = Members::orderBy('display_name', 'ASC')->get();

        return view('admin.contents.wages_total', $data);
    }

    public function wages_advance(){
        $data['all_advances'] = AdvancePayment::orderBy('AvansID', 'DESC')->get();
        
        return view('admin.contents.wages_advance', $data);
    }
}
