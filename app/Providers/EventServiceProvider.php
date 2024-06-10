<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Laravel\Cashier\Events\InvoicePaid' => [
            'Modules\Subscription\Listeners\HandleInvoicePaidNotification',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
        \Event::listen('Alexusmai\LaravelFileManager\Events\Deleted',
            function ($event) {
                //sync the media deletion in db.media_uploads
                $media_items = $event->items();
                $total_deleted_media = 0;
                if(!empty($media_items)) {
                    foreach($media_items as $media_item) {
                        $media_file = \basename($media_item['path']);
                        $media_path = \dirname($event->disk().DIRECTORY_SEPARATOR.$media_item['path']);
                        $total_deleted_media += \DB::table(\app(\App\Models\MediaUpload::class)->getTable())->where('name',$media_file)->where('path',$media_path)->delete();
                    }
                }
                //\Log::info('Deleted: synced items = '.$total_deleted_media, [$event->disk(),$event->items()]);
            }
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
