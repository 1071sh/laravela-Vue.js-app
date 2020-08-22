<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\SubCategory;

class Domain extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
