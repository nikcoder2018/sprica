<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Language as LangSetting;
use App\Setting;
use App\Language;
use App\Code;
use App\VacationDay;
use App\TicketType;
use App\EmailTemplate;
use App\EmailTrigger;
use App\EmailAction;
use App\EmailCommand;
use App\Time;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    //
    public function general_settings(Request $request)
    {
        $data['genset'] = Setting::orderBy('GenelID', 'DESC')->first();
        $data['ticket_types'] = TicketType::orderBy('id', 'ASC')->get();
        $data['vacationdays'] = VacationDay::orderBy('GunID', 'DESC')->get();
        $data['codes'] = Code::orderBy('KodID', 'DESC')->get();
        $data["templates"] = EmailTemplate::all();
        $data['text_templates'] = EmailTemplate::select('id', 'body', 'title')->where('word_template', true)->get();
        $data['triggers'] = EmailTrigger::with(['template', 'action'])->get();
        $data['actions'] = EmailAction::with('command')->get();
        $data['commands'] = EmailCommand::all();
        $stime = $request->user()->settings()->where('key', 'default_start_time')->first();
        $data['default_start_time'] = $stime ? $stime->value : '07:00';
        $data['times'] = Time::all();
        return view('admin.contents.settings', $data);
    }

    public function general_settings_update(Request $request)
    {
        $gensetting = Setting::where('GenelID', 1)->first();

        if ($gensetting) {
            $gensetting->SiteURL = $request->SiteURL;
            $gensetting->KacSAAT = $request->KacSAAT;
            $gensetting->save();
        }

        /**
         * @var \App\User
         */
        $user = $request->user();

        // theme
        if ($request->has('theme')) {
            $user->setSetting('theme', $request->input('theme'));
        }

        // default start time
        if ($request->has('default_start_time')) {
            $user->setSetting('default_start_time', $request->input('default_start_time'));
        }

        // working hours
        if ($request->has('working_hour')) {
            $user->setSetting('working_hour', $request->input('working_hour'));
        }

        if ($request->has('avatar') && $request->file('avatar')->isValid()) {
            if ($user->getAttributes()['avatar'] !== 'public/users-avatar/avatar.png') {
                // GC
                Storage::delete($user->getAttributes()['avatar']);
            }

            /**
             * @var \Illuminate\Http\UploadedFile
             */
            $file = $request->file('avatar');
            $user->avatar = $file->storePublicly('/public/users-avatar');
        }

        $user->fill($request->only(['username', 'name', 'email', 'company']));
        $user->save();


        if ($request->expectsJson()) {
            return response()->json(array('success' => true, 'msg' => 'General Settings Updated!'));
        }
        return redirect()->back();
    }
    public function language_settings()
    {
        $data['languages'] = Language::all();

        return view('admin.contents.settings_language', $data);
    }

    public function language_settings_update(Request $request)
    {
        foreach ($request->input() as $key => $value) {
            if ($key != '_token') {
                $language = Language::where('DilBASLIK', $key)->first();
                if ($language) {
                    if ($language->DilKARSILIK != $value) {
                        $language->DilKARSILIK = $value;
                        $language->save();
                    }
                }
            }
        }

        return response()->json(array('success' => true, 'msg' => LangSetting::settings('Dil_Ayarlari_Guncellendi')));
    }

    public function code_settings()
    {
        $data['codes'] = Code::orderBy('KodID', 'DESC')->get();
        return view('admin.contents.settings_codes', $data);
    }

    public function code_settings_store(Request $request)
    {

        $code = Code::create([
            'Kod' => $request->Kod,
            'KodBASLIK' => $request->KodBASLIK,
            'Parabir' => $request->Parabir,
            'Paraiki' => $request->Paraiki,
            'Yatti' => $request->Yatti
        ]);

        if ($code) {
            return response()->json(array('success' => true, 'msg' => 'Code added!'));
        }
    }

    public function vacationdays_settings()
    {
        $data['vacationdays'] = VacationDay::orderBy('GunID', 'DESC')->get();
        return view('admin.contents.settings_vacationdays', $data);
    }

    public function vacationdays_settings_store(Request $request)
    {
        $vd = VacationDay::create([
            'Tarih' => $request->Tarih,
            'GunBASLIK' => $request->GunBASLIK,
        ]);

        if ($vd) {
            return response()->json(array('success' => true, 'msg' => 'Vacation Day added!', 'details' => $vd));
        }
    }

    public function vacationdays_settings_edit(Request $request)
    {
        $vd = VacationDay::find($request->GunID);

        return response()->json($vd);
    }
    public function vacationdays_settings_update(Request $request)
    {
        $vd = VacationDay::find($request->GunID);
        $vd->Tarih = $request->Tarih;
        $vd->GunBASLIK = $request->GunBASLIK;
        $vd->save();

        if ($vd) {
            return response()->json(array('success' => true, 'msg' => 'Vacation Day Updated!', 'details' => $vd));
        }
    }

    public function vacationdays_settings_delete(Request $request)
    {
        $vd = VacationDay::find($request->GunID);
        $vd->delete();

        if ($vd) {
            return response()->json(array('success' => true, 'msg' => 'Vacation Day Deleted!', 'id' => $vd->GunID));
        }
    }
}
