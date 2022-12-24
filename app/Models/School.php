<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;
    use HasFactory;
use Auditable;
    public const IS_ACTIVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public const IS_APPROVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'schools';

    public static $searchable = [
        'name',
        'eiin',
        'post_office',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'division_id',
        'district_id',
        'upazila_id',
        'eiin',
        'post_office',
        'mobile',
        'management',
        'mpo',
        'is_approve',
        'is_active',
        'address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function schoolUsers()
    {
        return $this->hasMany(User::class, 'school_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
