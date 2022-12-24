<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    use HasFactory;
    use Auditable;
    public $table = 'event_user';
    protected $fillable = ['user_id','event_id','approved_by'];


    public static function checkEventRegistration($event_id){
        $eventUser = EventUser::where('event_id', $event_id)->where('user_id', auth()->id())->first();
        if ($eventUser){
            return true;
        }else{
            return false;
        }
    }
}
