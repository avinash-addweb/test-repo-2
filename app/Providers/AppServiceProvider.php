<?php

namespace App\Providers;

use App\Repositories\AdminRepository;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Builder;
use Laravel\Cashier\Cashier;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\RoleRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\PermissionRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface;
use App\Repositories\LanguageRepository;
use App\Repositories\Interfaces\MediaUploadRepositoryInterface;
use App\Repositories\MediaUploadRepository;
use App\Repositories\Interfaces\GeneralSettingRepositoryInterface;
use App\Repositories\GeneralSettingRepository;
use App\Repositories\Interfaces\ActivityLogRepositoryInterface;
use App\Repositories\ActivityLogRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
        );
        $this->app->bind(
            AdminRepositoryInterface::class,
            AdminRepository::class,
        );
        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class,
        );
        $this->app->bind(
            PermissionRepositoryInterface::class,
            PermissionRepository::class,
        );
        $this->app->bind(
            LanguageRepositoryInterface::class,
            LanguageRepository::class,
        );
        $this->app->bind(
            MediaUploadRepositoryInterface::class,
            MediaUploadRepository::class,
        );
        $this->app->bind(
            GeneralSettingRepositoryInterface::class,
            GeneralSettingRepository::class,
        );
        $this->app->bind(
            ActivityLogRepositoryInterface::class,
            ActivityLogRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //for cashier tax calculations in laravel stripe
        //Cashier::calculateTaxes();

        if(config('app.env')!='local') {
            //enable the debugbar on local environment only
            \Debugbar::disable();
        }
        //Builder::useVite();
        try {
            $dbStatus = DB::connection()->getPdo();
            if (!empty($dbStatus) && Schema::hasTable(\app(\App\Models\GeneralSetting::class)->getTable()) && Schema::hasTable(\app(\App\Models\MediaUpload::class)->getTable())) {
                foreach (\App\Models\GeneralSetting::with(['generalSettingImage'])->get() as $generalSetting) {
                    if(!empty($generalSetting->setting_type) && $generalSetting->setting_type == 'image') {
                        \Illuminate\Support\Facades\Config::set('settings.' . $generalSetting->setting_key, (!empty($generalSetting->generalSettingImage->name) && !empty($generalSetting->generalSettingImage->path)) ? $generalSetting->generalSettingImage->path.DIRECTORY_SEPARATOR.$generalSetting->generalSettingImage->name : $generalSetting->setting_value);
                    } else {
                        \Illuminate\Support\Facades\Config::set('settings.' . $generalSetting->setting_key, $generalSetting->setting_value);
                    }
                }
            }
            //\Illuminate\Support\Facades\Config::set('services.stripe.currency','inr');
            //\Illuminate\Support\Facades\Config::set('services.stripe.currency_symbol',"₹");
        } catch (\Exception $e) {}


    }
}
