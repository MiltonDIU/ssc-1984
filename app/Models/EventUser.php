<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    use HasFactory;
    public $table = 'event_user';
    protected $fillable = ['user_id','event_id','approved_by'];
}
