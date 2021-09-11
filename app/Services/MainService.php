<?php

namespace App\Services;

use Illuminate\Support\Str;

/**
 * Class MainService
 * @package App\Services
 */
class MainService
{

    public function getErrorMessagges($errors)
    {
        $message = collect();
        $collection = collect($errors);
        $keys = $collection->keys();
        foreach ($keys as $key) {
            $message->put($key, $this->getByKey($collection[$key]));
        };
        return $message;
    }

    public function getByKey($array)
    {
        foreach ($array as $item) {
            return $item;
        }
    }
    
    public function createSlug($title, $model)
    {
        $i = 1;
        $slug = Str::slug($title, '-');
        $slugLoop = $slug;
        while ($model::where('slug', $slugLoop)->first()) {
            $slugLoop = $slug . '-' .  +$i;
            $i++;
        }

        return $slugLoop;
    }

    public function generatePaginationFormat($data){

        $response = ['current_page' => $data['current_page'], 'data' => $data['data'], 'total' => $data["total"]];

        return $response;
    }

}
