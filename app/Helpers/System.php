<?php 

namespace App\Helpers;


use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Notice;
use App\NoticeRead;
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
            if($number(Cache::get('tatilmi_bak')->where('Tarih',$girilentarih)) > 0){
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
    public static function getNews(){
        $readIds = array();

        $notices_read = NoticeRead::where('user_id', auth()->user()->id)->get();
        foreach($notices_read as $notice){
            array_push($readIds, $notice->notice_id);
        }
        $notices = Notice::where('to', 'ALL')->whereNotIn('id', $readIds)->get();

        return $notices;
    }
    public static function cevir($tarih)
    {
        $parcala = explode("-",$tarih);
        $yeni_tarih= $parcala[2].".".$parcala[1].".".$parcala[0];
        return $yeni_tarih;
    }
    
    public static function gun_bas_kisa($tarih){
        $tarih=explode ("-",$tarih);
        $gun = date("l",mktime(0,0,0,$tarih[1],$tarih[2],$tarih[0]));
        $gun_ingilizce = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
        $turkce_gun = array('Mo','Di','Mi','Do','Fr','Sa','So');
        $gun_degis = str_replace($gun_ingilizce,$turkce_gun,$gun);
        return $gun_degis;

    }

    public static function pazarmibak($girilentarih)
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

    public static function cumartesimibak($girilentarih)
    {
        $tarih=explode ("-",$girilentarih);
        $gun = date("l",mktime(0,0,0,$tarih[1],$tarih[2],$tarih[0]));
        $gun_ingilizce = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
        $turkce_gun = array('Pazartesi','Salı;','Çarşamba','Perşembe','Cuma','Cumartesi','Pazar');
        $gun_degis = str_replace($gun_ingilizce,$turkce_gun,$gun);

        if( $gun_degis=="Cumartesi")
        {
            return true;
        }else
        {
            return false;

        }
    }

    /**
     * Format bytes to kb, mb, gb, tb
     *
     * @param  integer $size
     * @param  integer $precision
     * @return integer
     */
    public static function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }

    public static function get_avatar($str){
        $acronym = '';
        $word = '';
        $words = preg_split("/(\s|\-|\.)/", $str);
        foreach($words as $w) {
            $acronym .= substr($w,0,1);
        }
        $word = $word . $acronym ;
        return $word;
    }

    public static function simplifyNumbers($number){
        if ($number >= 1000 && $number < 1000000) {
            return round($number/1000, 1) . "K";
        } elseif($number >= 1000000 && $number < 1000000000) {
            return round($number/1000000, 1) . "M";
        } elseif($number >= 1000000000) {
            return round($number/1000000000, 1) . "B";
        }else{
            return $number;
        }
    }
}