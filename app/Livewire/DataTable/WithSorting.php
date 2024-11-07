<?php

namespace App\Livewire\DataTable;

trait WithSorting
{
    public $sorts = [];
    public $default_sorts = [];
    public function sortBy($field, $status = false)
    {
        // return to sort by event
       foreach($this->default_sorts as $key => $value){
          unset($this->sorts[$key]);
       }

       if (! isset($this->sorts[$field])) return $this->sorts[$field] = 'asc';

       if ($this->sorts[$field] === 'asc') return $this->sorts[$field] = 'desc';

        unset($this->sorts[$field]);
    }

    public function applySorting($query)
    {
        $this->sorts = !empty($this->sorts) ? $this->sorts : $this->default_sorts;
        foreach ($this->sorts as $field => $direction) {
            $query->orderBy($field, $direction);
        }

        return $query;
    }
}
