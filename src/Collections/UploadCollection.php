<?php namespace EscapeWork\LaravelUploader\Collections;

use Illuminate\Support\Collection;

class UploadCollection extends Collection
{

    public function __toString()
    {
        return $this->first()['name'];
    }
}
