<?php
namespace App\Providers;

use App\Http\Controllers\UserController;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $menus = (new UserController())->menuRender(Auth::id());
            $view->with('menus', $menus);
        });
    }
}
