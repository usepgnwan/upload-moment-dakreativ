<?php

namespace App\Livewire\Dashboard;

use App\Models\Paket;
use App\Models\UsersPelanggan;
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
        $paket = Paket::count();
        // $userPelanggan = UsersPelanggan::count();
        $userPelanggan = UsersPelanggan::join('pakets', 'users_pelanggans.paket_id', '=', 'pakets.id')
            ->selectRaw('COUNT(users_pelanggans.id) as user_count, SUM(pakets.harga) as total_amount')
            ->first();
        $total_pelanggan = $userPelanggan->user_count;
        $total_pendapatan = number_format( $userPelanggan->total_amount, 0, ',', '.');
        return view('livewire.dashboard.home',[
            'paket' => $paket,
            'total_pelanggan' => $total_pelanggan,
            'total_pendapatan' => $total_pendapatan,
        ]);
    }
}
