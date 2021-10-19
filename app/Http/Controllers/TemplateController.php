<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTemplate;

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

    public function createTemplate(Request $request)
    {
        unset($request['_token']);

        $content = json_encode($request->all());

        $data = [
            'template_id' => 1,
            'content' => $content,
        ];

        UserTemplate::create($data);

        return 1;
    }
}
