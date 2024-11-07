<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Title('Login')]
    #[Rule('required')]
    public string $email = '';

    #[Rule('required')]
    public string $password = '';

    public function mount(){
        if (Auth::check()) {
            return redirect()->route('account.dashboard');
        }
    }
    public function login(){

        try{
             $this->validate();

            // $login = $request->email;
            $fieldType = filter_var($this->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $usercheck = User::where($fieldType, $this->email)->first();
            if(is_null($usercheck)){
                throw ValidationException::withMessages([
                    'email' => 'Akun anda belum terdaftar/tidak ditemukan.',
                ]);
                return;
            }
            if($usercheck->status == 'register'){
                throw ValidationException::withMessages([
                    'email' => 'Akun anda belum aktif. Silahkan hubungi admin.',
                ]);
                return;
            }else if($usercheck->status == 'non-aktif'){
                throw ValidationException::withMessages([
                    'email' => 'Akun anda sudah tidak aktif. Silahkan hubungi admin.',
                ]);
                return;
            }


            if(Auth::attempt([$fieldType => $this->email, 'password' => $this->password])){

                $this->notify('Berhasil login');
                return redirect()->route('account.dashboard');

            }
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }catch (\Illuminate\Validation\ValidationException $e){
            session()->flash('notify',['message' => $e->getMessage()]);
            throw $e;
        }

    }
    public function render()
    {
        return view('livewire.login');
    }
}
