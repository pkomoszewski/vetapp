<?php

namespace App\QueryFilters;

use Cerbero\QueryFilters\QueryFilters;

class VetFilters extends QueryFilters
{
    public function name($pharse)
    {
        $this->query->where('name', 'like', '%' . $pharse . '%');
    }

    public function category($id) {
        $this->query->where('category_id', $id);
    }

    public function from($price) {
        $this->query->where('price', '>=', $price);
    }

    public function to($price) {
        $this->query->where('price', '<=', $price);
    }
}