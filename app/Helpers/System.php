<?php 

namespace App\Helpers;
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
}