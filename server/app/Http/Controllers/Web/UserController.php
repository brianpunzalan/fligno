<?php

namespace App\Http\Controllers\Web;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
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
    public function search(Request $request)
    {
        $q = $request->query('q');
        $results = $this->users->search($q);
        return view('index', ['users' => $results]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', ['users' => $this->users->list(2)]);
    }

    /**
     * Display Sign Up form
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm() 
    {
        return view('forms.sign-up');
    }

    /**
     * Display Registration Success Page
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationSuccess(Request $request)
    {
        $user = $request->session()->get('user');
        if ($user) {
            return view('pages.register-success', ['user' => $user]);
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signUp(Request $request)
    {
        $user = $this->users->create($request);
        return redirect()->route('register.success')->with(['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @param string $id \App\User id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return view('pages.profile', ['user' => User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Log::info(json_encode($user) . "\n\n\n" . $user->id);
        return response()->json($this->users->delete($user->id));
    }
}
