<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;
    use HasFactory;
use Auditable;
    public const IS_ACTIVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'districts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'division_id',
        'name',
        'slug',
        'bn_name',
        'lat',
        'lot',
        'url',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function districtUpazilas()
    {
        return $this->hasMany(Upazila::class, 'district_id', 'id');
    }

    public function districtEvents()
    {
        return $this->hasMany(Event::class, 'district_id', 'id');
    }

    public function districtUsers()
    {
        return $this->hasMany(User::class, 'district_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function districtSchools()
    {
        return $this->hasMany(School::class, 'district_id', 'id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
