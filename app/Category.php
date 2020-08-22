<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subcategory;
use App\Domain;

class Category extends Model
{
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
}
