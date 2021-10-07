<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    function getAllTemplates()
    {
        // TODO: get templates from db
        return view('select-template.index', [
            'templates' => [1, 2, 3, 4, 5, 6, 7, 8]
        ]);
    }

    public function showTemplate($id)
    {
        // demo
        $template = file_get_contents('storage/template/meo.html');

        return view('select-template.show', ['template' => $template]);
    }
}
