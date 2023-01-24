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
    protected $fillable = ['user_id','event_id','approved_by','amount','driver','spouse','driver_amount','spouse_amount','payment_status'];


    public static function checkEventRegistration($event_id){
        $eventUser = EventUser::where('event_id', $event_id)->where('user_id', auth()->id())->first();
        if ($eventUser){
            return true;
        }else{
            return false;
        }
    }

    public static function getRegisterUser($event_id){
        $eventUser = EventUser::where('event_id', $event_id)->where('user_id', auth()->id())->first();
        if ($eventUser){
            return $eventUser;
        }else{
            return false;
        }
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
