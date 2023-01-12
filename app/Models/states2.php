<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class states2 extends Model
{
    use HasFactory;
    public $table = 'states2';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city()
    {
        return $this->hasMany(cities2::class, 'state_id', 'id');
    }

}
