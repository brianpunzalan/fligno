<?php

namespace Fligno\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Image;

class Avatar extends Facade 
{

	/**
	 * Create Avatar
	 * 
	 * @param string $avatar
	 * @param int $x
	 * @param int $y
	 * @param int $width
	 * @param int $height
	 * @param int $size
	 * @return void
	 */
	public function create($avatar, $x, $y, $width, $height, $size = null)
	{
		$path = public_path(Storage::url($avatar));
		$avatar = Image::make($avatarUrl)->encode('jpeg');
		$avatar->crop($width, $height, $x, $y);
		if (!empty($size)) {
			$avatar->heighten($size);
		}
		$avatar->save($path);
	}

	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'avatar';
    }
}