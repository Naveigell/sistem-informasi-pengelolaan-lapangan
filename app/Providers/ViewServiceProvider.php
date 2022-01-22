<?php

namespace App\Providers;

use App\View\Composers\NonactiveMember;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('layouts.karyawan.header', NonactiveMember::class);
    }
}
