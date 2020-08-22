<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Domain;

class Subcategory extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
}
