<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Code;
use App\Setting;
use App\Watches;

class TimeTrackingController extends Controller
{
    public function index(){
        $data['page_title'] = 'Time Sheet';
        $data['projects'] = Project::whereNotIn('ProjeBASLIK', ['Feiertag','Urlaub','Krank','KUG'])->orderBy('projeKODU', 'ASC')->get();
        $data['codes'] = Code::all();
        $data['timelogs'] = Watches::where('UyeID', auth()->user()->id)->orderBy('Tarih', 'DESC')->get();
        return view('contents.timetracking', $data);
    }
    public function store(Request $request){
        $saat = $request->Saat; 
        $code = $request->Kod; 

        $kacsaat = Setting::where('GenelID', 1)->first()->KacSAAT;
        if(Watches::where('Tarih', $request->Tarih)->where('UyeID', auth()->user()->id)->count() < $kacsaat){

            if($request->ProjeID == 1 || $request->ProjeID == 2){
                $saat = 8;
                $kod = 12;
            }

            $time = Watches::create([
                'UyeID' => auth()->user()->id,
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
    }

    public function destroy(Request $request){
        $time = Watches::find($request->SaatID);
        $time->delete();

        if($time){
            return response()->json(array('success' => true, 'msg' => 'Time Deleted!'));
        }
    }
}
