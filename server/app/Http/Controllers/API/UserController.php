<?php

namespace Fligno\Http\Controllers\API;

use Fligno\User;
use Fligno\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Fligno\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Display search results from query
     *
     * @return \Illuminate\Http\Response
     */
    public function search($query = '')
    {
        $results = $this->users->search($query);
        return response()->json($results);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users->all()->makeHidden(['api_token']);
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->users->create($request);
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Fligno\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user->makeHidden(['api_token']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Fligno\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = $this->users->update($user->id, $request->input())->makeHidden(['api_token']);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Fligno\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return response()->json($this->users->delete($user->id));
    }
}
