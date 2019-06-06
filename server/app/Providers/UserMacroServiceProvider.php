<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\Log;

class UserMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('guest', function ($attributes) {
            $prohibitedAttributes = [
                "password",
                "remember_token",
                "email_verified_at",
                "created_at",
                "updated_at"
            ];

            return UserMacroServiceProvider::filter($attributes, $prohibitedAttributes);
        });

        Response::macro('guestList', function($paginated) {
            $before = $paginated->toArray();
            Log::info($before["data"]);
            $list = $before["data"];
            $newList = array();
            foreach ($list as $item) {
                $prohibitedAttributes = [
                    "password",
                    "remember_token",
                    "email_verified_at",
                    "created_at",
                    "updated_at"
                ];

                $newList[] = UserMacroServiceProvider::filter($item, $prohibitedAttributes);
            }
            $after = $before;
            $after["data"] = $newList;
            return $after;
        });

        Collection::macro('guest', function () {
            return $this->map(function ($value) {
                $prohibitedAttributes = [
                    "password",
                    "remember_token",
                    "email_verified_at",
                    "created_at",
                    "updated_at"
                ];
                return UserMacroServiceProvider::filter($value, $prohibitedAttributes);
            });
        });

        Response::macro('admin', function ($user, $data) {
            $prohibitedAttributes = [];

            return UserMacroServiceProvider::filter($attributes, $prohibitedAttributes);
        });
    }


    public static function filter($attributes, $prohibitedAttributes = []) {
        $result = array();
        foreach ($attributes as $key => $attribute) {
            if (!in_array($key, $prohibitedAttributes)) {
                $result[$key] = $attribute;
            }
        }

        return $result;
    }
}
