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
            $content = $request['content'];

            foreach ($content as $key => $val) {
                if ($val['value'] !== null) {
                    $value = str_replace("\n", " ", $val['value']);

                    $content[$key]['value'] = $value;
                }
            }

            $result = UserTemplate::create([
                'template_id' => $templateId,
                'content' => json_encode($content),
            ]);

            return response([
                'status' => 200,
                'id' => $result->id
            ]);
        }

        return response([
            'status' => 500,
            'message' => Config::get('messages.not_found_data')
        ]);
    }

    public function downloadTemplate($userTemplateId)
    {
        $userTemplate = UserTemplate::with('template')->find($userTemplateId);

        if ($userTemplate) {
            $html = file_get_contents('storage/templates/html/' . $userTemplate->template->url);

            return view($this->dirView . 'download', [
                'html' => $html,
                'content' => $userTemplate->content
            ]);
        }
    }
}
