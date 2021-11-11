<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequests\CreateRequest;
use App\Http\Requests\CategoryRequests\EditRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    protected $dirView = 'pages.admin.categories.';

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
        $categories = Category::with('creator', 'updater')->get();

        return DataTables::of($categories)
            ->addColumn('img', function ($category) {
                $path = "storage/categories/" . $category->img_url;

                return '<img src="'. asset($path) .'" width="200px" height="120px"/>';
            })
            ->addColumn('creator', function ($category) {
                return $category->creator ? $category->creator->username : '';
            })
            ->addColumn('updater', function ($category) {
                return $category->updater ? $category->updater->username : '';
            })
            ->addColumn('action', function ($category) {
                return '<a href="'. route('admin.categories.edit', $category) .'" class="btn btn-sm btn-info mr-1">
                            <i class="fa fa-edit"></i>
                        </a>';
            })
            ->rawColumns(['img', 'creator', 'updated_by', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view($this->dirView . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->only(['name', 'description']);

        if ($request->hasFile('img_url')) {
            $fileName = $request->file('img_url')->getClientOriginalName();

            $request->file('img_url')->storeAs(Config::get('constants.PATH.CATEGORY'), $fileName);

            $data['img_url'] = $fileName;
        }

        $data['created_by'] = Auth::user()->id;

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', Config::get('messages.create_success'));
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
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', Config::get('messages.not_found_data'));
        }

        return view($this->dirView . 'edit', [
            'category' => $category
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
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', Config::get('messages.not_found_data'));
        }

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('img_url')) {
            $fileName = $request->file('img_url')->getClientOriginalName();

            $request->file('img_url')->storeAs(Config::get('constants.PATH.CATEGORY'), $fileName);

            $data['img_url'] = $fileName;
        }

        $data['updated_by'] = Auth::user()->id;

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', Config::get('messages.update_success'));
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
