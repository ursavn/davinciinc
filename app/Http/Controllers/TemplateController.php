<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    function getAllTemplates()
    {
        return view('pages.users.template.index', [
            'templates' => [1, 2, 3, 4, 5, 6, 7, 8]
        ]);
    }

    public function showTemplate($id)
    {
        // demo
        $template = file_get_contents('storage/template/meo.html');

        return view('pages.users.template.show', ['template' => $template]);
    }
}
