<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateRequests\CreateRequest;
use App\Http\Requests\TemplateRequests\EditRequest;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class TemplatesController extends Controller
{
    protected $dirView = 'pages.admin.templates.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view($this->dirView . 'index');
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $templates = Template::with('category', 'creator', 'updater')->get();

        return DataTables::of($templates)
            ->addColumn('category', function ($template) {
                return $template->category ? $template->category->name : '';
            })
            ->addColumn('creator', function ($template) {
                return $template->creator ? $template->creator->username : '';
            })
            ->addColumn('updater', function ($template) {
                return $template->updater ? $template->updater->username : '';
            })
            ->addColumn('action', function ($template) {
                return '<div class="d-flex">
                            <a href="'. route('admin.templates.edit', $template) .'" class="btn btn-sm btn-info mr-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="POST" action="'. route('admin.templates.destroy', $template) .'">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-sm btn-danger" onClick="return confirmDelete()">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>';
            })
            ->rawColumns(['creator', 'updated_by', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view($this->dirView . 'create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->only(['name', 'description', 'category_id']);

        $data['created_by'] = Auth::user()->id;

        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->getClientOriginalName();

            $request->file('file')->storeAs(Config::get('constants.PATH.TEMPLATE'), $fileName);

            $data['url'] = $fileName;
        }

        Template::create($data);

        return view($this->dirView . 'index')->with("success", "Create success.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template   = Template::find($id);
        $categories = Category::all();

        return view($this->dirView . 'edit', [
            'template'   => $template,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, $id)
    {
        $template = Template::find($id);

        if (!$template) {
            return view($this->dirView . 'index')->with("error", "Not found data.");
        }

        $data = $request->only(['name', 'description', 'category_id']);

        $data['updated_by'] = Auth::user()->id;

        if ($request->hasFile('file')) {
            $oleFile = Config::get('constants.PATH.TEMPLATE') . '/' . $request->old_file;
            if( File::exists(public_path($oleFile)) ) {
                File::delete(public_path($oleFile));
            }

            $fileName = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs(Config::get('constants.PATH.TEMPLATE'), $fileName);

            $data['url'] = $fileName;
        }

        $template->update($data);

        return view($this->dirView . 'index')->with("success", "Updated success.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
