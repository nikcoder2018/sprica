<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

use App\EmailCommand;
use App\EmailAction;
use App\EmailTemplate;
use App\User;

class EmailTrigger extends Model
{
    protected $table = "email_triggers";
    protected $fillable = ['template_id','action_id'];
    protected $variables = array();

    function template(){
        return $this->hasOne(EmailTemplate::class, 'id','template_id');
    }
    function action(){
        return $this->hasOne(EmailAction::class, 'id','action_id');
    }
    function scopeExecute($query, $command, $attributes){
        $command_id = EmailCommand::where('code', $command)->first()->id;
        $actions = EmailAction::where('command_id', $command_id)->get();

        switch($command){
            case 'NEW_TASK_CREATED':
                foreach($actions as $action){
                    $triggers = $query->where('action_id', $action->id)->get();
                    foreach($triggers as $trigger){
                        $assigned_user = User::find($attributes['user_id']);
                        $template = EmailTemplate::find($trigger->template_id);
                        
                        //insert data to email
                        $this->setVariables('name', $assigned_user->name);

                        $subject = $this->convertPlaceholders($template->subject);
                        $body = $this->convertPlaceholders($template->body);
                        if($assigned_user->email != ''){
                            Mail::to($assigned_user->email)->send(new SendMail($subject, $body));

                             // check for failures
                            if (Mail::failures()) {
                                // return response showing failed emails
                                if( count(Mail::failures()) > 0 ) {
                                    echo "There was one or more failures. They were: <br />";
                                 
                                    foreach(Mail::failures() as $email_address) {
                                        echo " - $email_address <br />";
                                     }

                                     exit;
                                 } 
                            }

                        }
                    }
                }
            break;
        }

        return array('success' => true, 'msg' => 'Trigger Executed.');
    }

    function setVariables($name, $value){
        $this->variables[$name] = $value;
    }

    function convertPlaceholders($template){
        $result = '';
        foreach($this->variables as $name=>$value):
            $result = str_replace('[['.$name.']]',$value, $template);
        endforeach;

        return $result;
    }
}
