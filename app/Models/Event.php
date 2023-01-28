<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;
use Auditable;
    public const IS_FREE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public const IS_ACTIVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'events';

    public static $searchable = [
        'name',
    ];

    protected $appends = [
        'banner',
    ];

    protected $dates = [
        'event_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_category_id',
        'name',
        'slug',
        'details',
        'event_date',
        'event_time',
        'event_end_time',
        'address',
        'district_id',
        'is_free',
        'price',
        'spouse_amount',
        'driver_amount',
        'venue',
        'created_at',
        'is_active',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function event_category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function getBannerAttribute()
    {
        $file = $this->getMedia('banner')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getEventDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEventDateAttribute($value)
    {
        $this->attributes['event_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('approved_by','amount','driver','spouse','driver_amount','spouse_amount','payment_status');
    }
    public static function lastFiveusers()
    {
       // return $this->belongsToMany(User::class)->orderBy('id','asc')->take(10);
//        $users = EventUser::orderBy('id','desc')->get()->take(2);
        $users = EventUser::orderBy('id','desc')->get()->take(10);

        return $users->reverse();
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function eventUser()
    {
        return $this->hasMany(EventUser::class);
    }
//    public static function enrollment($event_id){
//
//        if (count(auth()->user()->userEvents()->where('id', $event_id)->get())>0){
//            return true;
//        }else{
//            return false;
//        }
//    }
}
