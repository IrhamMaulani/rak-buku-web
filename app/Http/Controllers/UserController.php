<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Author;
use Illuminate\Http\Request;
use App\Http\Resources\UserItem;
use App\Http\Requests\UserValidation;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    private $user, $author, $role;

    public function __construct(User $user, Author $author, Role $role)
    {
        $this->user = $user;
        $this->author = $author;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request->ajax() ? new UserCollection($this->user->with('roles')->get()) : view('admin.home');
        return new UserCollection($this->user->with(['roles', 'reputation'])->get());
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
    public function store(UserValidation $request)
    {

        try {
            $this->user->create(array_merge(
                $request->except([
                    'password_confirmation',
                    'roles'
                ]),
                ['reputation_id' => $request->reputation['id']]
            ))->roles()->attach($this->role->getId($request->roles));
            return response()->json(__('app.store_success'));
        } catch (\Exception $e) {
            return response()->json('failed' . $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserItem($this->user->findOrFail($id));
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
    public function update(UserValidation $request, $id)
    {

        $user = $this->user->findOrFail($id);
        try {
            $user->update(array_merge(
                $request->except([
                    'password_confirmation',
                    'roles'
                ]),
                ['reputation_id' => $request->reputation['id']]
            ));

            $user->roles()->sync($this->role->getId($request->roles));

            return response()->json('success');
        } catch (\Exception $e) {
            return response()->json('failed' . $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->user->destroy($id);
            return response()->json('success');
        } catch (\Exception $e) {
            return response()->json('failed' . $e);
        }
    }
}
