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

    public $state = 'public';
    public $access = 'all';
    public $hasMoreData ='start';
    public $countRows =0 ;
    public $refreshKey =0 ;

    #[On('newUpload')]
    public function handleNewUpload($foto){
        $this->refreshGallery();
    }
    // #[On('editAccess')]
    // public function handleEditAccess($val){
    //     $this->access = $val;
    //     $this->refreshGallery();
    // }



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
        // dd($this->rows);
        $gallery1 = collect($this->gallery1)->toArray();
        $gallery2 = collect($this->gallery2)->toArray();
        $data = array_merge($gallery1,$gallery2);
        $_data = [];
        foreach($data as $k => $v){
            $_data[$k]['href'] = $v['file'];
            $_data[$k]['type'] = 'image';
            $_data[$k]['title'] = $v['messages']['name'];
            $_data[$k]['description'] = $v['messages']['description'];
        }
        // dd($_data);
        // $this->dispatch('reinitGlithbox',$_data);

    }
    public function placeholder(){
        return view('livewire.front.placeholder.sceleton-gallery-foto');
    }
    public function getRowsProperty(){
        $gallery = UserMoment::where('user_pelanggan_id', '=',$this->id)
        ->skip(count($this->gallery1) + count($this->gallery2))
        ->when($this->access != 'all', function($query){
            return $query->where('type', '=', $this->access);
        })
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
                $this->gallery2[] = $v;
            } else {
                $this->gallery1[] = $v;
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
