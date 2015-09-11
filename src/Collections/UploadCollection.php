<?php

namespace EscapeWork\LaravelUploader\Collections;

use Illuminate\Support\Collection;

class UploadCollection extends Collection
{

    public function __toString()
    {
        $first = $this->first();

        if (isset($first['name'])) return $first['name'];

        return $first;
    }
}
