<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\UserTemplate;

class TemplateController extends Controller
{
    protected $dirView = 'pages.users.template.';

    public function getAllTemplates()
    {
        $templates = Template::paginate(8);

        return view($this->dirView . 'index', [
            'templates' => $templates
        ]);
    }

    public function showTemplate($id)
    {
        $template = Template::find($id);

        if ($template) {
            $template->content = file_get_contents('storage/templates/html/' . $template->url);

            return view($this->dirView . 'create', ['template' => $template]);
        }

        return redirect()->route('select-template');
    }

    public function createTemplate($templateId, Request $request)
    {
        $template = Template::find($templateId);

        if ($template) {
            unset($request['_token']);
            $htmlUrl = $request->html_url;

            UserTemplate::create([
                'template_id' => $templateId,
                'content' => json_encode($request->content),
            ]);

            return response([
                'status' => 200,
                'content' => $request->content
            ]);
        }

        return response([
            'status' => 500,
            'message' => Config::get('messages.not_found_data')
        ]);
    }

    public function downloadTemplate(Request $request)
    {
        $html = file_get_contents('storage/templates/html/' . $request->html_url);

        return view($this->dirView . 'download', [
            'html' => $html,
            'content' => $request->content
        ]);
    }
}
