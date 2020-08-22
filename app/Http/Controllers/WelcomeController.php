<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Category;
use App\Subcategory;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $domains = Domain::get();
        $categories = Category::get();
        $subcategories = Subcategory::get();

        return view('welcome')->with('domains', $domains)->with('subcategories', $subcategories)->with('categories', $categories);
    }
}
