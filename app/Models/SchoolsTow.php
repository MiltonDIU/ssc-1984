<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolsTow extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const IS_ACTIVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public const IS_APPROVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'schools_tows';

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
        'district',
        'upazila',
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
