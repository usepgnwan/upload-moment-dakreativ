<?php

namespace App\Livewire\Dashboard;

use App\Livewire\DataTable\WithBulkActions;
use App\Livewire\DataTable\WithCachedRows;
use App\Livewire\DataTable\WithPerPagePagination;
use App\Livewire\DataTable\WithSorting;
use App\Models\Paket as ModelsPaket;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Paket extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;
    #[Layout('components.layouts.account_page')]
    #[Title('Paket')]
    public $filters = [
        'search' => '',
    ];
    protected $queryString = ['sorts'];

    public $request = [
        'title' => null,
        'harga' => null,
        'limit_file' => null,
        'limit_hari' => null,

    ];
    public bool $showFilters = false;
    public array $breadcumb = [];
    public $showDeleteModal = false;
    public $showEditModal = false;
    public ModelsPaket $_data;

    public function rules()
    {
        return [
            'request.title' => 'required|min:3',
            'request.harga' => 'required',
            'request.limit_file' => 'required',
            'request.limit_hari' => 'required',
        ];
    }

    public function validationAttributes () {
        return [
            'request.title' => 'Paket',
            'request.harga' => 'Harga',
            'request.limit_file' => 'Limti File',
            'request.limit_hari' => 'Max Akses (Hari)',
        ];
    }

    public function mount(){
        $this->_data = $this->makeBlankTransaction();
        $this->default_sorts = ['created_at' => 'desc'];
        $this->breadcumb = [
            'Home' => [
                'active' => true,
                'route_name' => 'account.dashboard'
            ],
            'Paket' =>  [
                'active' => false,
            ]
        ];
    }

    public function toggleShowFilters()
    {
        $this->useCachedRows();

        $this->showFilters = ! $this->showFilters;
    }

    function makeBlankTransaction()
    {
        return ModelsPaket::make();
    }
    public function save()
    {
       try {
            $this->validate();
            if(!$this->_data->id){
                $this->_data->create($this->request);
            }else{
                // Update the user
                $this->_data->fill($this->request);
                $this->_data->save();
                $message = 'Succes update paket '.$this->_data->title;
            }

            $this->notify($message ?? 'Succes create paket '. $this->request['title']);
            $this->showEditModal = false;

        } catch (\Illuminate\Validation\ValidationException $e) {

            $this->notify('Periksa kembali form isian', 'warning');

            throw $e;
        }
    }
    public function create()
    {
        $this->_data = $this->makeBlankTransaction();
        $this->request = $this->_data->getAttributes();
        $this->showEditModal = true;
    }

    public function edit(ModelsPaket $data)
    {
        $this->useCachedRows();
        if ($this->_data->isNot($data)) $this->_data = $data;
        $this->request['title']  = $this->_data->title;
        $this->request['harga']  = $this->_data->harga;
        $this->request['limit_file']  = $this->_data->limit_file;
        $this->request['limit_hari']  = $this->_data->limit_hari;
        $this->showEditModal = true;
    }
    public function deleteSelected()
    {

        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->selectPage = false;
        $this->notify('You\'ve deleted '.$deleteCount.' transactions');
    }
    public function resetFilters() { $this->reset('filters'); }
    public function updatedFilters()
    {
        $this->resetPage();
    }
    public function getRowsQueryProperty()
    {
        // dd($this->perPage);
        $query = ModelsPaket::query()
        ->when($this->filters['search'], function($query){
            return $query->where('title', 'like','%'. $this->filters['search'] .'%');
        });

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
        return $this->applyPagination($this->rowsQuery);
        });
    }
    public function render()
    {
        return view('livewire.dashboard.paket',[
            'data' => $this->rows,
        ]);
    }
}
