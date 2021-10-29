<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::all();

        return view('pages.users.home', [
            'categories' => $categories
        ]);
    }
}
