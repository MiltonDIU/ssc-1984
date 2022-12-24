<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upazila extends Model
{
    use SoftDeletes;
    use HasFactory;
use Auditable;
    public const IS_ACTIVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'upazilas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'district_id',
        'name',
        'slug',
        'bn_name',
        'url',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function upazilaSchools()
    {
        return $this->hasMany(School::class, 'upazila_id', 'id');
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'upazila_id', 'id');
    }

    public function upazilaAddresses()
    {
        return $this->hasMany(Address::class, 'upazila_id', 'id');
    }

    public function upazilaUsers()
    {
        return $this->hasMany(User::class, 'upazila_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
