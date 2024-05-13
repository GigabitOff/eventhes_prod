<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'slug', 'allfoto','data_create_order','currency','amount','social_show_facebook','social_show_instagram','is_live','is_links','social_show_youtube','social_show_telegram','social_show_x'];

    public function setFotoLogoAttribute($value)
    {
        if ($value) {
            $originalName = $value->getClientOriginalName();
            $this->attributes['foto_logo'] = $originalName;
        }
    }

    public function setFotoTitleAttribute($value)
    {
        if ($value) {
            $originalName = $value->getClientOriginalName();
            $this->attributes['foto_title'] = $originalName;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shedule()
    {
        return $this->hasOne(Shedule::class);
    }

    public function lessonType()
    {
        return $this->hasOne(LessonType::class, 'events_id', 'id');
    }

    public function user_orders()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function town()
    {
        return $this->belongsTo(Town::class, 'town_id', 'id');
    }


}


