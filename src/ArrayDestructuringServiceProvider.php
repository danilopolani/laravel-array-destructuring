<?php

namespace Danilopolani\ArrayDestructuring;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class ArrayDestructuringServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Arr::macro(
            'destructure',
            /**
             * Destructure an array from the given keys.
             *
             * @param  array  $array
             * @param  array|string  $keys
             * @return array
             */
            function (array $array, $keys): array {
                $keys = self::wrap($keys);
                $results = [];

                foreach ($keys as $key) {
                    if (is_array($key)) {
                        $results[] = self::only($array, $key);
                    } else {
                        $results[] = array_key_exists($key, $array) ? $array[$key] : null;
                    }
                }

                $results[] = self::except($array, self::flatten($keys));

                return $results;
            }
        );
    }
}
