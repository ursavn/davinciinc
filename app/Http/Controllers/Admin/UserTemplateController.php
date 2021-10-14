<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserTemplate;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class UserTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.admin.user-templates.index');
    }

    public function anyData()
    {
        $userTemplates = UserTemplate::all();

        return DataTables::of($userTemplates)
            ->addColumn('template_name', function ($userTemplate) {
                return $userTemplate->template ? $userTemplate->template->name : '';
            })
            ->addColumn('template_url', function ($userTemplate) {
                return $userTemplate->template ? $userTemplate->template->url : '';
            })
            ->addColumn('action', function ($userTemplate) {
                return '<a href="'. route('admin.user-templates.show', $userTemplate) .'" class="btn btn-sm btn-info mr-1">
                            <i class="fa fa-eye"></i>
                        </a>';
            })
            ->rawColumns(['template_name', 'template_url', 'action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userTemplate = UserTemplate::find($id);

        if (!$userTemplate) {
            return redirect()->route('admin.user-templates.index')->with('error', Config::get('messages.not_found_data'));
        }

        $content = json_decode($userTemplate->content);

        return view('pages.admin.user-templates.show', [
            'userTemplate' => $userTemplate,
            'content' => $content
        ]);
    }
}
