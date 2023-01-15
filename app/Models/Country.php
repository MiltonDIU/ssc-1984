<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const FLAG_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public const IS_ACTIVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'countries';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'iso3',
        'numeric_code',
        'iso2',
        'phonecode',
        'capital',
        'currency',
        'currency_name',
        'currency_symbol',
        'tld',
        'native',
        'region',
        'subregion',
        'timezones',
        'translations',
        'latitude',
        'longitude',
        'emoji',
        'emoji_u',
        'wiki_data',
        'flag',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function countryStates()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }
    public function states()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function state()
    {
        return $this->hasMany(states2::class, 'country_id', 'id');
    }
}
