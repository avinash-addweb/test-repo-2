<?php

namespace Modules\Testimonial\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TestimonialLocale extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['testimonial_id','lang_code','name','designation','contents'];
    
    protected static function newFactory()
    {
        return \Modules\Testimonial\Database\factories\TestimonialLocaleFactory::new();
    }
    public function tapActivity(\Spatie\Activitylog\Contracts\Activity $activity, string $eventName)
    {
        $activity->description = (\Auth::user()?->email??"")." : testimonial {$eventName}";
        $userLocationData = getUserLatestLoginLocationFromUid(\Auth::user()?->id,true);
        $activity->ip = $userLocationData['ip_address']??\request()->ip()??"";
        $activity->location = $userLocationData['location']??"";
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('testimonial')
        ->logOnly(self::getFillable())
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
    /**
     * Get the testimonial that owns the testimonialLocale.
     */
    public function testimonial()
    {
        return $this->belongsTo(Testimonial::class);
    }
}
