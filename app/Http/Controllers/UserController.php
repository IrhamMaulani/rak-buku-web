<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Author;
use App\Http\Requests\UserValidation;

class UserController extends Controller
{

    private $user, $author;

    public function __construct(User $user, Author $author)
    {
        $this->user = $user;
        $this->author = $author;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->ajax() ? new UserCollection($this->user->with('roles')->get()) : view('admin.home');
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
                $request->except(['password_confirmation', 'roles']),
                ['isAuthor' => $this->author->isAuthor($request->roles)]
            ))->roles()->attach($request->roles);

            return response()->json('success');
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
    public function update(UserValidation $request, $id)
    {

        $user = $this->user->findOrFail($id);
        try {
            $user->update(array_merge(
                $request->except(['password_confirmation', 'roles']),
                ['isAuthor' => $this->author->isAuthor($request->roles)]
            ));

            $user->roles()->sync($request->roles);

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
