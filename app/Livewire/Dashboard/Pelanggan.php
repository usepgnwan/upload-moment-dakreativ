<?php

namespace App\Livewire\Dashboard;

use App\Helpers\GenerateBarcode;
use App\Livewire\DataTable\WithBulkActions;
use App\Livewire\DataTable\WithCachedRows;
use App\Livewire\DataTable\WithPerPagePagination;
use App\Livewire\DataTable\WithSorting;
use App\Models\Event;
use App\Models\Paket;
use App\Models\UsersPelanggan;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Pelanggan extends Component
{
    use WithFileUploads;
    use GenerateBarcode;
    use WithPerPagePagination, WithSorting, WithBulkActions, WithCachedRows;
    #[Layout('components.layouts.account_page')]
    #[Title('Pelanggan')]
    public $filters = [
        'search' => '',
    ];
    protected $queryString = ['sorts'];

    public $request = [
        'name' => null,
        'foto' => null,
        'foto_sampul' => null,
        'event_id' => null,
        'paket_id' => null,
    ];

    public $_foto = null;
    public $_foto_sampul = null;
    public $detailPaket = [];
    public bool $showFilters = false;
    public array $breadcumb = [];
    public $showDeleteModal = false;
    public $showEditModal = false;
    public UsersPelanggan $_data;

    public function rules()
    {
        if (is_string($this->request['foto'])) {
            $this->_foto = $this->request['foto'];
            $this->request['foto'] = null;
        }

        if (is_string($this->request['foto_sampul'])) {
            $this->_foto_sampul = $this->request['foto_sampul'];
            $this->request['foto_sampul'] = null;
        }
        return [
            'request.name' => 'required|min:3',
            'request.foto' => 'nullable|image|mimes:jpg,png,jpeg,svg,gif|max:2048',
            'request.foto_sampul' => 'nullable|image|mimes:jpg,png,jpeg,svg,gif|max:2048',
            'request.event_id' => 'required',
            'request.paket_id' => 'required',

        ];
    }

    public function validationAttributes()
    {
        return [
            'request.name' => 'Nama Pelanggan',
            'request.foto' => 'Foto',
            'request.foto_sampul' => 'Foto Sampul',
            'request.event_id' => 'Event',
            'request.paket_id' => 'Paket',
        ];
    }

    public function updatedRequestPaketId($val)
    {
        $this->reset('detailPaket');
        if ($val != null) {
            $this->detailPaket = collect(Paket::find($val))->toArray();
        }
    }

    public function mount()
    {
        $this->_data = $this->makeBlankTransaction();
        $this->default_sorts = ['created_at' => 'desc'];
        $this->breadcumb = [
            'Home' => [
                'active' => true,
                'route_name' => 'account.dashboard'
            ],
            'Pelanggan' =>  [
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
        return UsersPelanggan::make();
    }
    public function save()
    {
        try {
            $this->validate();

            if (isset($this->request['foto']) && is_string($this->request['foto']) === false && !is_null($this->request['foto'])) {
                // Check if this is an update and the post has an old image
                if ($this->_data && $this->_data->image) {
                    // Check if the old image exists in storage

                    $prev_img = str_replace('/storage/', '', $this->_data->foto);

                    if (Storage::disk('public')->exists($prev_img)) {
                        // Delete the old image
                        Storage::disk('public')->delete($prev_img);
                    }
                }
                // Store the new image
                $this->request['foto'] = $this->request['foto']->store('images', 'public');

                // Generate the URL for the stored image
                $this->request['foto'] = Storage::url($this->request['foto']);
            } else {
                // If no new image is uploaded, retain the existing image URL
                $this->request['foto'] =  $this->_foto == 'remove' ? null : ($this->_data->foto ?? null);
            }

            if (isset($this->request['foto_sampul']) && is_string($this->request['foto_sampul']) === false && !is_null($this->request['foto_sampul'])) {
                // Check if this is an update and the post has an old image
                if ($this->_data && $this->_data->image) {
                    // Check if the old image exists in storage

                    $prev_img = str_replace('/storage/', '', $this->_data->foto_sampul);

                    if (Storage::disk('public')->exists($prev_img)) {
                        // Delete the old image
                        Storage::disk('public')->delete($prev_img);
                    }
                }
                // Store the new image
                $this->request['foto_sampul'] = $this->request['foto_sampul']->store('images', 'public');

                // Generate the URL for the stored image
                $this->request['foto_sampul'] = Storage::url($this->request['foto_sampul']);
            } else {
                // If no new image is uploaded, retain the existing image URL
                $this->request['foto_sampul'] =  $this->_foto_sampul == 'remove' ? null : ($this->_data->foto_sampul ?? null);
            }

            $this->request['user_id'] = auth()->user()->id;

            if (!$this->_data->id) {
                $this->request['token'] = 'DKR-' . Str::random(5);
                $this->_data->create($this->request);
            } else {
                // Update the user
                $this->_data->fill($this->request);
                $this->_data->save();
                $message = 'Succes update pelanggan ' . $this->_data->name;
            }

            $this->notify($message ?? 'Succes create pelanggan ' . $this->request['name']);
            $this->showEditModal = false;
        } catch (\Illuminate\Validation\ValidationException $e) {

            $this->notify('Periksa kembali form isian', 'warning');

            throw $e;
        }
    }
    public function create()
    {
        $this->reset('detailPaket');
        $this->dispatch('reinitSelect2');
        $this->_data = $this->makeBlankTransaction();
        $this->reset('request');
        $this->showEditModal = true;
    }

    public function edit(UsersPelanggan $mapel)
    {
        $this->dispatch('reinitSelect2');
        $this->useCachedRows();
        if ($this->_data->isNot($mapel)) $this->_data = $mapel;
        $this->request['name']  = $this->_data->name;
        $this->request['title']  = $this->_data->title;
        $this->request['foto']  = $this->_data->foto;
        $this->request['foto_sampul']  = $this->_data->foto_sampul;
        $this->request['event_id']  = $this->_data->event->id;
        $this->request['paket_id']  = $this->_data->paket->id;
        $this->updatedRequestPaketId($this->_data->paket->id);
        $this->showEditModal = true;
    }


    public function deleteSelected()
    {

        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteModal = false;

        $this->selectPage = false;
        $this->notify('You\'ve deleted ' . $deleteCount . ' transactions');
    }
    public function resetFilters()
    {
        $this->reset('filters');
    }
    public function updatedFilters()
    {
        $this->resetPage();
    }
    public function getRowsQueryProperty()
    {
        // dd($this->perPage);
        $query = UsersPelanggan::query()
            ->when($this->filters['search'], function ($query) {
                return $query->where('title', 'like', '%' . $this->filters['search'] . '%');
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
        $event = Event::all();
        $paket = Paket::all();
        return view('livewire.dashboard.pelanggan', [
            'data' => $this->rows,
            'event' => $event,
            'paket' => $paket,
        ]);
    }
}
