<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Spouse extends Model implements HasMedia
{
    use HasFactory;
    use HasFactory;
    use InteractsWithMedia;



    protected $appends = [
        'avatar',
    ];

    protected $fillable = [
        'name',
        'user_id',
        'created_by_id',
        'event_id'
    ];



    public function getAvatarAttribute()
    {
        $file = $this->getMedia('avatar')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
