<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequests\CreateRequest;
use App\Http\Requests\UserRequests\EditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $users = User::all();

        return DataTables::of($users)
            ->addColumn('role', function ($user) {
                $roles = User::$roles;

                return $roles[$user->role];
            })
            ->addColumn('creator', function ($user) {
                $creator = '';
                if ($user->created_by)
                    $creator = User::find($user->created_by)->username;

                return $creator;
            })
            ->addColumn('updater', function ($user) {
                $updater = '';
                if ($user->updated_by)
                    $updater = User::find($user->updated_by)->username;

                return $updater;
            })
            ->addColumn('action', function ($user) {
                return '<a href="'. route('admin.users.edit', $user) .'" class="btn btn-sm btn-info mr-1">
                            <i class="fa fa-edit"></i>
                        </a>';
            })
            ->rawColumns(['role', 'creator', 'updater', 'action'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = User::$roles;

        return view('pages.admin.users.create', [
            'roles' => $roles
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
        $data = $request->only(['username', 'email', 'password', 'role']);

        $data['created_by'] = Auth::user()->id;

        if ($request->hasFile('avatar')) {
            $imageName = $request->file('avatar')->getClientOriginalName();

            $request->file('avatar')->storeAs(Config::get('constants.PATH.AVATAR'), $imageName);

            $data['avatar'] = $imageName;
        }

        User::create($data);

        return redirect()->route('admin.users.index');
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
        $user  = User::find($id);
        $roles = User::$roles;

        return view('pages.admin.users.edit', [
            'user'  => $user,
            'roles' => $roles
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
        $user = User::find($id);

        if (!$user) {
            return view($this->dirView . 'index')->with("error", Config::get('messages.not_found_data'));
        }

        $data = $request->only(['username', 'email', 'role']);

        $data['updated_by'] = Auth::user()->id;

        if ($request->hasFile('avatar')) {
            $imageName = $request->file('avatar')->getClientOriginalName();

            $request->file('avatar')->storeAs(Config::get('constants.PATH.AVATAR'), $imageName);

            $data['avatar'] = $imageName;
        }

        $user->update($data);

        return redirect()->route('admin.users.index');
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
