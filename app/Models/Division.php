<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes;
    use HasFactory;
use Auditable;
    public const IS_ACTIVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'divisions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'bn_name',
        'url',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function divisionDistricts()
    {
        return $this->hasMany(District::class, 'division_id', 'id');
    }

    public function divisionSchools()
    {
        return $this->hasMany(School::class, 'division_id', 'id');
    }

    public function divisionUsers()
    {
        return $this->hasMany(User::class, 'division_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
