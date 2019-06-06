<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Image;

class UserRepository {

	/**
	 * Storage for Eloquent User Collection
	 *
	 * @var \Illuminate\Database\Eloquent\Collection
	 */
	protected $users;

	/**
	 * Initialize User Repository to set User Collection
	 */
	public function __construct() 
	{
		$this->users = User::all();
	}

	/**
	 * Display search results from query
	 *
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 */
	public function search($query = '')
	{
		return DB::table('users')
						->where('first_name', 'like', "$query%")
						->orWhere('last_name', 'like', "$query%")
						->paginate();
	}

	/**
	 * Refresh users list collection
	 */
	public function refresh() 
	{
		$this->users = $this->users->fresh();
	}

	/**
	 * Get all users in the list
	 * 
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all() 
	{
		return $this->users;
	}

	/**
	 * Display search results from query
	 *
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 */
	public function list($limit = null) 
	{
		return DB::table('users')->paginate($limit);
	}

	/**
	 * Create new User in the Database
	 * 
	 * @param Illuminate\Http\Request
	 */
	public function create(Request $request) 
	{
		// validate request inputs
		$request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'avatar' => 'required',
			'avatar_crop_x' => 'required',
			'avatar_crop_y' => 'required',
			'avatar_crop_width' => 'required',
			'avatar_crop_height' => 'required',
			'email' => 'required|email',
			'password' => 'required'
		]);

		// initialize data for processing
		$avatarCroppedData = $request->only(['avatar_crop_x', 'avatar_crop_y', 'avatar_crop_height', 'avatar_crop_width']);
		$data = $request->except(['_token', 'avatar_crop_x', 'avatar_crop_y', 'avatar_crop_height', 'avatar_crop_width']);
		
		// handle avatar
		$avatarPath = $request->file('avatar')->store('avatars', 'public');
		$path = public_path(Storage::url($avatarPath));
		$image = Image::make($path)->encode('jpeg');
		$width = (int) $avatarCroppedData['avatar_crop_width'];
		$height = (int) $avatarCroppedData['avatar_crop_height'];
		$x = (int) $avatarCroppedData['avatar_crop_x'];
		$y = (int) $avatarCroppedData['avatar_crop_y'];
		$image->crop($width, $height, $x, $y);
		$image->heighten(400);
		$image->save($path);
		$data['avatar'] = $avatarPath;
		
		try {
			$user = User::create([
				'first_name' => $data['first_name'],
				'last_name' => $data['last_name'],
				'is_admin' => false,
				'gender' => $data['gender'],
				'description' => $data['description'],
				'password' => bcrypt($data['password']),
				'avatar' => $data['avatar'],
				'email' => $data['email'],
				'api_token' => Str::random(60),
			]);
		} catch (QueryException $e) {
			abort(400, $e->getMessage());
		}
		return $user;
	}

	/**
	 * Get User from the current list
	 * 
	 * @param string $id	USER ID
	 */
	public function get($id) {
		return $this->users->find($id);
	}

	/**
	 * Get User from the Database directly
	 * 
	 * @param string $id 	USER ID
	 */
	public function retrieve($id) 
	{
		try {
			$user = Users::find($id);
		} catch (QueryException $e) {
			abort(400);
		}
		return $user;
	}

	/**
	 * Update User in the Database directly
	 * 
	 * @param string $id	USER ID
	 * @param array $data	USER Attributes
	 */
	public function update($id, $data) 
	{
		try {
			$user = User::find($id)->update($data);
		} catch (QueryException $e) {
			abort(400);
		}
		return $user;
	}

	/**
	 * Delete User in the Database directly
	 * 
	 * @param string $id	USER ID
	 */
	public function delete($id) 
	{
		try {
			User::destroy($id);
		} catch (QueryException $e) {
			abort(400);
		}
		return true;
	}
}