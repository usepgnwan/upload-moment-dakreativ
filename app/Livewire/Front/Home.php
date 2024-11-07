<?php

namespace App\Livewire\Front;

use App\Helpers\GenerateZipFolder;
use App\Models\UserMessage;
use App\Models\UserMoment;
use App\Models\UsersPelanggan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Home extends Component
{
    use WithFileUploads,GenerateZipFolder;
    public $name = '';
    public $showUploadModal = false;
    public $user = [];
    public $foto = [];
    public $id_pelanggan = 0;
    public $id_messages = 0;
    public $modalMessages = true;

    public $type = 'public';

    public $request = [
        'file'=>null,
        'type' => null,
        'user_massage_id' => null,
        'user_pelanggan_id' => null,
        'ext'=>null
    ];

    public $message = [
        'user_pelanggan_id' => null,
        'name' => null,
        'description' => null,
    ];

    public function rulesRequest(){
        return [
            'request.file' => 'required|image|mimes:jpg,png,jpeg,svg,gif|max:20048',
        ];
    }

    public function rulesMessage(){
        return [
            'message.name' => 'required',
            'message.description' => 'required',
        ];
    }

    public function validationAttributes()
    {
        return [
            'message.name' => 'Nama',
            'message.description' => 'Pesan',
            'request.file' => 'Foto',
        ];
    }

    public function mount($slug =null, $type =null){

        $this->name = $slug;
        $this->user = UsersPelanggan::where('username','=',$slug)->FirstOrFail();
        $this->foto['foto_sampul'] = $this->user->foto_sampul != null ? $this->user['foto_sampul'] : $this->user['foto'];
        $this->foto['foto'] =   $this->user['foto'];
        $this->message['user_pelanggan_id'] = $this->user['id'];

        // jika messages ada maka modal di hidden
        if (isset($_COOKIE['dakreatif_messages_' .$this->message['user_pelanggan_id']])) {
            $this->modalMessages = false;
             // Mengambil dan mendekode data dari cookie
             $cookieData = json_decode($_COOKIE['dakreatif_messages_' .$this->message['user_pelanggan_id']], true);

            //  dd($cookieData);
             // Akses nilai di dalam cookie
             $this->id_messages = $cookieData['id'];
        }
    }

    public function save(){
        try {
            $this->validate($this->rulesMessage());
            $userMessage = UserMessage::create($this->message);
            // Mengatur cookie dengan masa berlaku 1 hari (86400 detik)
            setcookie('dakreatif_messages_'.$this->message['user_pelanggan_id'], json_encode(collect($userMessage)->toArray()), time() + 86400, '/');
            $this->modalMessages = false;
            $this->notify('Pesan kamu telah tersimpan. Saatnya berbagi momen bahagia dengan mengunggah foto di sini 😊');

        } catch (\Illuminate\Validation\ValidationException $e) {

            $this->notify('Periksa kembali form isian', 'warning');

            throw $e;
        }
    }

    public function upload_moment(){
        try {
            $this->validate($this->rulesRequest());
            $this->request['type'] = $this->type;
            $this->request['user_massage_id'] =  $this->id_messages;
            $this->request['user_pelanggan_id'] = $this->user['id'];
            if (isset($this->request['file']) && is_string($this->request['file']) === false && !is_null($this->request['file'])) {

                $this->request['ext'] = $this->request['file']->getClientOriginalExtension();

                // Store the new image
                $this->request['file'] = $this->request['file']->store('images/'.$this->user['username'] , 'public');

                // Generate the URL for the stored image
                $this->request['file'] = Storage::url($this->request['file']);
            }

            $foto = UserMoment::create($this->request);
            $this->dispatch('newUpload', $foto->id);
            $this->showUploadModal  =false;
            $this->reset('request');
            $this->notify('Foto tersimpan 😊');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->notify('Periksa kembali form isian', 'warning');

            throw $e;
        }
    }

    public function download_zip(){
        // Example usage
        // Assuming $this->user['username'] is set
        $username = $this->user['username'];

        // Define the source and output paths
        $sourcePath = storage_path('app/public/images/' . $username); // Folder to zip (images/username)
        $outputPath = storage_path('app/public/images/' .$username.'.zip'); // Output zip file

        // Make sure the source folder exists
        if (!File::exists($sourcePath)) {
            return "The folder doesn't exist.";
        }
        $generate = $this->generateZip($sourcePath,$outputPath );

        return response()->download($outputPath)->deleteFileAfterSend();
    }
    public function render()
    {
        return view('livewire.front.home')->title($this->user->name ." | Upload Moment");
    }
}
