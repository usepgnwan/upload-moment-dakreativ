<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Layout('components.layouts.account_page')]

    #[Title('Dashboard')]
    public $breadcumb = [];
    public function mount(){

        $this->breadcumb = [
            'Home' => [
                'active' => true,
                'route_name' => 'account.dashboard'
            ],
            'Dashboard' =>  [
                'active' => false,
            ]
        ];
    }
    public function render()
    {
        Log::info('Test log message');
        return view('livewire.dashboard.home');
    }
}
