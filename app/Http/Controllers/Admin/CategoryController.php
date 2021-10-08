<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    protected $dirView = 'admin.categories.';
    protected $category;

    public function __construct (Category $category)
    {
        $this->category = $category;
    }
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
                return '<div class="d-flex">
                            <a href="" class="btn btn-sm btn-info mr-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="POST" action="'. route('admin.categories.destroy', $category) .'"  >
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-sm btn-danger btn-delete" onClick="return confirmDelete()">
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view($this->dirView . 'index');
    }
}
