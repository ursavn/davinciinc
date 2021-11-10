<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\UserTemplate;
use App\Models\Category;

class TemplateController extends Controller
{
    protected $dirView = 'pages.users.template.';

    public function getTemplatesByCategory($categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return redirect()->route('home');
        }

        $templates = Template::where('category_id', $categoryId)->paginate(8);

        return view($this->dirView . 'index', [
            'templates' => $templates,
            'category' => $category
        ]);
    }

    public function showTemplate($categoryId, $templateId)
    {
        $category = Category::find($categoryId);
        $template = Template::find($templateId);

        if (!$category || !$template) {
            return redirect()->route('select-template-by-category', $categoryId);
        }

        $template->content = file_get_contents('storage/templates/html/' . $template->url);

        return view($this->dirView . 'create', ['template' => $template]);
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
