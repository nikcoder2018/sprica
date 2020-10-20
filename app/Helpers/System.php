<?php 

namespace App\Helpers;


use Illuminate\Support\Facades\Auth;
use App\Message;
use Cache;

class System
{
    /**
     * Fetch Cached settings from database
     *
     * @return string
     */
    public static function tatilmi_bak($girilentarih){
        $tarih=explode ("-",$girilentarih);
        $gun = date("l",mktime(0,0,0,$tarih[1],$tarih[2],$tarih[0]));
        $gun_ingilizce = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
        $turkce_gun = array('Pazartesi','Salı;','Çarşamba','Perşembe','Cuma','Cumartesi','Pazar');
        $gun_degis = str_replace($gun_ingilizce,$turkce_gun,$gun);

        if($gun_degis=="Pazar" OR $gun_degis=="Cumartesi"){
            return true;
        }else{
            if(count(Cache::get('tatilmi_bak')->where('Tarih',$girilentarih)) > 0){
                return true;
            }else{
                return false;
            }
        }
    }

    public static function getLatestMessages(){
        $messages = Message::with(['from','to'])
                        ->where('messages.seen', 0)
                        ->Where('messages.to_id', Auth::user()->id)
                        ->orderBy('messages.created_at', 'desc')
                        ->latest()
                        ->get()
                        ->unique('from_id');
        return $messages;
    }

    public static function cevir($tarih)
    {
        $parcala = explode("-",$tarih);
        $yeni_tarih= $parcala[2].".".$parcala[1].".".$parcala[0];
        return $yeni_tarih;
    }

    function gun_bas_kisa($tarih){
        $tarih=explode ("-",$tarih);
        $gun = date("l",mktime(0,0,0,$tarih[1],$tarih[2],$tarih[0]));
        $gun_ingilizce = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
        $turkce_gun = array('Mo','Di','Mi','Do','Fr','Sa','So');
        $gun_degis = str_replace($gun_ingilizce,$turkce_gun,$gun);
        return $gun_degis;

    }

    function pazarmibak($girilentarih)
    {
        global $db;
        $tarih=explode ("-",$girilentarih);
        $gun = date("l",mktime(0,0,0,$tarih[1],$tarih[2],$tarih[0]));
        $gun_ingilizce = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
        $turkce_gun = array('Pazartesi','Salı;','Çarşamba','Perşembe','Cuma','Cumartesi','Pazar');
        $gun_degis = str_replace($gun_ingilizce,$turkce_gun,$gun);

        if( $gun_degis=="Pazar")
        {
            return true;
        }else
        {
            return false;

        }
    }
}