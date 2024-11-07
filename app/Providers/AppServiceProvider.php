<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider
{
    public const HOME = '/account/dashboard'; // Set your desired home route here
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

        Schema::defaultStringLength(255);
        Component::macro('notify', function ($message, $type = 'success',$type1 = 'notify') {
            $msg = ['message'=>$message, 'type'=> $type];
            if($type1 == 'notify'){
                $this->dispatch('notify', $msg);
            }else if($type1 == 'flash'){
                session()->flash('notify', $msg);
            }
        });
    }
}
