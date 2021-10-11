<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequests\CreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $data['created_by'] = Auth::user()->id;

        Category::create($data);

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
        $category = Category::find($id);

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
    public function update(CreateRequest $request, $id)
    {
        dd(1);
        $category = Category::find($id);

        if (!$category) {
            return view($this->dirView . 'index')->with("error", "Not found data.");
        }

        $data = $request->only(['name', 'description']);

        $data['updated_by'] = Auth::user()->id;

        $category->update($data);

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
