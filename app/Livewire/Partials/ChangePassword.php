<?php

namespace App\Livewire\Partials;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class ChangePassword extends Component
{
    public $showModal = false;

    public $form = [
        'password' => '',
        'repeat_password' => '',
    ];

    public function rules()
    {
        return [
            'form.password' => 'required|min:6',
            'form.repeat_password' => 'required|same:form.password',
        ];
    }

    public function validationAttributes()
    {
        return [
            'form.password' => 'password',
            'form.repeat_password' => 'ulangi password',
        ];
    }
    #[On('showModal')]
    public function updateshowModal($status){
        $this->showModal = $status  ?? false;
    }

    public function submit(){
        try{
            $this->validate();
                    // Update the password
        auth()->user()->update([
            'password' => Hash::make($this->form['password']),
        ]);

        Auth::logoutOtherDevices($this->form['password']);
        $this->showModal = false;
        $this->notify('Sukses ganti password');
        $this->reset();
        }catch (\Illuminate\Validation\ValidationException $e){
            $this->notify('Periksa kembali formulir anda','warning');
            throw $e;
        }
    }
    public function render()
    {

        return view('livewire.partials.change-password');
    }
}
