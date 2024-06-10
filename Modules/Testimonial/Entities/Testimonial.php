<?php

namespace Modules\Testimonial\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Testimonial extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['email','status'];
    
    protected static function newFactory()
    {
        return \Modules\Testimonial\Database\factories\TestimonialFactory::new();
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
     * Get the testimonialLocales for the testimonial.
     */
    public function testimonialLocales()
    {
        return $this->hasMany(TestimonialLocale::class,'testimonial_id');
    }
    
    /**
     * Get the testimonialLocales with filter for the testimonial. //default lang_code is 'en'
     */
    public function testimonialLocale($lang_code='en')
    {
        $lang_code = (!empty($lang_code)) ? $lang_code : app()->getLocale();
        return $this->hasOne(TestimonialLocale::class,'testimonial_id')->where('lang_code',$lang_code);
    }

    public function testimonialImage()
    {
        return $this->hasOne(\App\Models\MediaUpload::class,'model_id')->where('media_for_attribute','image')->where('model_name','Modules\Testimonial\Entities\Testimonial');
    }
}
