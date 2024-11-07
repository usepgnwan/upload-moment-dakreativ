<?php

namespace App\Livewire\DataTable;

use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public $perPage = 10;

    public function mountWithPerPagePagination()
    {
        $this->perPage = $this->perPage ?? 10;
        $this->perPage = $this->perPage ?? session()->get('perPage', $this->perPage);
    }

    public function updatedPerPage($value)
    {
        $this->resetPage();
        $value = $value ?? 10;
        session()->put('perPage', $value);
    }

    public function applyPagination($query)
    {
        $this->perPage = $this->perPage ?? 10;

        return $query->paginate($this->perPage);
    }
}
