<?php namespace EscapeWork\LaravelUploader\Collections;

use Illuminate\Support\Collection;

class UploadCollection extends Collection
{

    public function __toString()
    {
        if (isset($this->first()['name'])) return $this->first()['name'];

        return $this->first();
    }
}
