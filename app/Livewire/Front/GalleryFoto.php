<?php

namespace App\Livewire\Front;

use App\Models\UserMoment;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\Attributes\On;

class GalleryFoto extends Component
{

    #[Lazy]

    public $id = null;
    public $page = 6;
    public $gallery1 = [];
    public $gallery2 = [];

    public $hasMoreData ='start';
    public $countRows =0 ;
    #[On('newUpload')]
    public function handleNewUpload($foto){
        $this->refreshGallery();
    }


    public function mount(){

        $this->GalleryData;
    }

    public function refreshGallery()
    {
        // Clear gallery arrays
        $this->reset('gallery1', 'gallery2');

        // // Reset pagination and state
        // $this->page = 6;
        // $this->hasMoreData = 'start';
        // $this->countRows = 0;
        $this->GalleryData;

    }
    public function placeholder(){
        return view('livewire.front.placeholder.sceleton-gallery-foto');
    }
    public function getRowsProperty(){
        $gallery = UserMoment::where('user_pelanggan_id', '=',$this->id)
        ->skip(count($this->gallery1) + count($this->gallery2))
        ->take($this->page)->orderBy('created_at', 'desc')->get();
        return $gallery;
    }

    public function readMore(){
        $this->page =6;
        $this->hasMoreData = 'load';
        $this->GalleryData;
    }

    public function getGalleryDataProperty(){

        if ($this->rows->isEmpty() && $this->hasMoreData =='start') {
            $this->hasMoreData = 'start';
            $this->countRows = 0;
        }else{
            $this->hasMoreData = 'load';
            $this->countRows = 1;
        }

        // Check if new rows are empty
        if ($this->rows->isEmpty() && $this->hasMoreData != 'start') {
            $this->hasMoreData = 'end';
            $this->countRows = 1;
        }

         // Fetch fresh data
         foreach ($this->rows as $k => $v) {
            if ($k % 2 == 1) {
                $this->gallery1[] = $v;
            } else {
                $this->gallery2[] = $v;
            }
        }
    }
    public function render()
    {

        return view('livewire.front.gallery-foto', [
            'gallery1' => $this->gallery1,
            'gallery2' => $this->gallery2,
        ]);
    }
}
