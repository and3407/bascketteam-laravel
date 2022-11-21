<?php

namespace App\Components\Helpers;

use Illuminate\Support\Arr;

class ArrayHelper
{
    public function getRandomItem(array $array): mixed
    {
        return Arr::random($array);
    }
}
