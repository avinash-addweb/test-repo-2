<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
//use Laravel\Fortify\Contracts\ResetPasswordViewResponse;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::authenticateUsing(function (Request $request) {
            DB::enableQueryLog();
//            $user = \App\Models\Admin::where('email', $request->email)->whereHas('roles', function($model)use($request){
//                return ($request->wantsJson()) ? $model->where('is_for_client',1) : $model->where('is_for_admin',1);
//            })->where('status',1)->first();

            $user = \App\Models\Admin::with("roles")->where('email', $request->email)->where('status',1)->first();
//            dd($user->hasRole(config('constants.superadmin_role')));
            if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                if($user->hasRole(config('constants.super_admin_role'))) {
                    //user logs for efficient use of location api
                    $userLocation = getMyLocationFromIp();
                    $userIp = $request->ip();
                    \App\Models\UserLog::create(['user_id' => $user->id, 'event_name' => 'login', 'ip_address' => $userIp, 'location' => $userLocation]);
                    //activity logs
                    activity()->useLog('login')->event('login')->causedBy($user)->tap(function (\Spatie\Activitylog\Contracts\Activity $activity) use ($userIp, $userLocation) {
                        $activity->ip = $userIp ?? "";
                        $activity->location = $userLocation ?? "";
                    })->log(($user?->email) . ':login success');

                    return $user;
                }else{
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        Fortify::username() => __("You don't have permission to access this page."),
                    ]);
                }
            } else {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    Fortify::username() => __("Invalid credentials, please try again."),
                ]);
            }
        });

        Fortify::registerView(fn () => view('auth.register',['roles'=>\App\Models\Role::where('name','!=',config('constants.superadmin_role'))->where(function($model){
                return (1 || request()->wantsJson()) ? $model->where('is_for_client',1) : $model->where('is_for_admin',1);
            })->get()->pluck('name')->toArray()]));

        //override the login response
        $this->app->instance(LoginResponse::class, new class implements LoginResponse{
            public function toResponse($request){
                if($request->wantsJson()) {
                    $user = \App\Models\User::where('email',$request->email)->first();
                    if (empty($user->stripe_id)) {
                        //create stripe customer id, if not exist
                        $user?->createOrGetStripeCustomer();
                    }
                    return response()->json([
                        'code' => 200,
                        'message' => __("You are successfully logged in."),
                        'data' => [
                            'name' => $user->name,
                            'email' => $user->email,
                            'role' => (($user?->roles[0])?->name)??"",
                            'token' => $user->createToken($request->email)->plainTextToken,
                        ]
                    ],200);
                }
                return redirect()->intended(Fortify::redirects('login'));
            }
        });

        //override the register response
        $this->app->instance(RegisterResponse::class, new class implements RegisterResponse{
            public function toResponse($request){
                if($request->wantsJson()) {
                    $user = \App\Models\User::where('email',$request->email)->first();
                    return response()->json([
                        'code' => 200,
                        'message' => __("You are successfully registered."),
                        'data' => [
                             'name' => $user->name,
                             'email' => $user->email,
                             'role' => (($user?->roles[0])?->name)??"",
                             'token' => $user->createToken($request->email)->plainTextToken,
                        ]
                    ],200);
                }
                return redirect()->intended(Fortify::redirects('register'));
            }
        });
        

        //override the logout response
        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse{
            public function toResponse($request){
                if($request->wantsJson()) {
                    return response()->json([
                        'code' => 200,
                        'message' => __("You are successfully logged out."),
                        'data' => []
                    ],200);
                }
                return redirect()->intended(Fortify::redirects('logout'));
            }
        });

        //override the SuccessfulPasswordResetLinkRequestResponse response
        $this->app->instance(SuccessfulPasswordResetLinkRequestResponse::class, new class implements SuccessfulPasswordResetLinkRequestResponse{
            public function toResponse($request){
                if($request->wantsJson()) {
                    return response()->json([
                        'code' => 200,
                        'message' => __("We have emailed your password reset link"),
                        'data' => [
                            'email' => $request->email
                        ]
                    ],200);
                }
                return redirect()->intended(Fortify::redirects('reset-passwords'));
            }
        });
        

        //

    }
}
