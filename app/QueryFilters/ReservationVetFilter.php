<?php

namespace App\QueryFilters;

use Cerbero\QueryFilters\QueryFilters;

class ReservationVetFilter extends QueryFilters
{
    
    public function vet($id)
    {
     
        $this->query->where('vet_id', $id);
    }

    public function confirm()
    {
     
        $this->query->where('status',0);
    }

   
}