<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\EmailService;
use Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MyCustomService::class, function ($app) {
            return new MyCustomService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('mimecheck', function ($attribute, $value, $parameters, $validator) {
            $mimeType = $value->getMimeType();
            // dd($value->getMimeType());
            if($mimeType == 'application/pdf' || $mimeType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $mimeType == 'application/msword')
            {
                return true;
            }
            else
            {
                return false;
            }
            // return $value == 'foo';
        });
    }
}
