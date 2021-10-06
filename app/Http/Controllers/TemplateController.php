<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    function getAllTemplates()
    {
        // TODO: get templates from db
        return view('select-template', [
            'templates' => [1, 2, 3, 4, 5, 6, 7, 8]
        ]);;
    }
}
