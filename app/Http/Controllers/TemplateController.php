<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\UserTemplate;

class TemplateController extends Controller
{
    public function getAllTemplates()
    {
       $templates = Template::all();

       return view('pages.users.template.index', [
           'templates' => $templates
       ]);
    }

    public function showTemplate($id)
    {
        $template = Template::find($id);

        if ($template) {
            $template->content = file_get_contents('storage/templates/html/' . $template->url);

            return view('pages.users.template.show', ['template' => $template]);
        }

        return redirect()->route('select-template');
    }

    public function createTemplate($templateId, Request $request)
    {
        unset($request['_token']);

        $content = json_encode($request->all());

        $data = [
            'template_id' => $templateId,
            'content' => $content,
        ];

        UserTemplate::create($data);

        return 1;
    }
}
