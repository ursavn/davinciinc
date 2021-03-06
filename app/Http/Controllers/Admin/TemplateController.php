<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateRequests\CreateRequest;
use App\Http\Requests\TemplateRequests\EditRequest;
use App\Models\Category;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class TemplateController extends Controller
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
            ->addColumn('img', function ($template) {
                $path = "storage/templates/image/" . $template->img_url;

                return '<img src="'. asset($path) .'" width="100px" />';
            })
            ->addColumn('action', function ($template) {
                $path = "storage/templates/html/" . $template->url;

                return '<div class="d-flex">
                            <div class="">
                                <a href="'. asset($path) .'" download="'. $template->url .'" class="btn btn-sm btn-dark mr-1">
                                   <i class="fa fa-cloud-download"></i>
                                </a>
                            </div>
                            <div>
                                <a href="'. route('admin.templates.edit', $template) .'" class="btn btn-sm btn-info mr-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                            <form action="'. route('admin.templates.destroy', $template) .'" method="POST">
                                <input type="hidden" name="_token" value="'. csrf_token().'">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger" onClick="return confirmDelete()">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>';
            })
            ->rawColumns(['img', 'category', 'creator', 'updated_by', 'action'])
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

        if ($request->hasFile('html_url')) {
            $fileName = $request->file('html_url')->getClientOriginalName();

            $request->file('html_url')->storeAs(Config::get('constants.PATH.TEMPLATE.HTML'), $fileName);

            $data['url'] = $fileName;
        }

        if ($request->hasFile('img_url')) {
            $fileName = $request->file('img_url')->getClientOriginalName();

            $request->file('img_url')->storeAs(Config::get('constants.PATH.TEMPLATE.IMAGE'), $fileName);

            $data['img_url'] = $fileName;
        }

        Template::create($data);

        return redirect()->route('admin.templates.index')->with('success', Config::get('messages.create_success'));
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
        $template = Template::find($id);

        if (!$template) {
            return redirect()->route('admin.templates.index')->with('error', Config::get('messages.not_found_data'));
        }

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
            return redirect()->route('admin.templates.index')->with('error', Config::get('messages.not_found_data'));
        }

        $data = $request->only(['name', 'description', 'category_id']);

        $data['updated_by'] = Auth::user()->id;

        if ($request->hasFile('html_url')) {
            $fileName = $request->file('html_url')->getClientOriginalName();

            $request->file('html_url')->storeAs(Config::get('constants.PATH.TEMPLATE.HTML'), $fileName);

            $data['url'] = $fileName;
        }

        if ($request->hasFile('img_url')) {
            $fileName = $request->file('img_url')->getClientOriginalName();

            $request->file('img_url')->storeAs(Config::get('constants.PATH.TEMPLATE.IMAGE'), $fileName);

            $data['img_url'] = $fileName;
        }

        $template->update($data);

        return redirect()->route('admin.templates.index')->with('success', Config::get('messages.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::find($id);

        if (!$template) {
            return redirect()->route('admin.templates.index')->with('error', Config::get('messages.not_found_data'));
        }

        $template->delete();

        return redirect()->route('admin.templates.index')->with('success', Config::get('messages.delete_success'));
    }
}
