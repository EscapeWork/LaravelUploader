<?php

namespace EscapeWork\LaravelUploader\Validators;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

class MimeTypeArrayValidator
{

    public function validate($attribute, $array, $parameters)
    {
        $parameters = count($parameters) === 0 ? ['jpg', 'jpeg', 'png'] : $parameters;

        if (! is_array($array)) return false;

        foreach ($array as $value) {
            if (! $value) {
                continue;
            }

            if (! $this->validateMimes($attribute, $value, $parameters)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check that the given value is a valid file instance.
     *
     * @param  mixed  $value
     * @return bool
     */
    protected function isAValidFileInstance($value)
    {
        if ($value instanceof UploadedFile && ! $value->isValid()) return false;

        return $value instanceof File;
    }

    /**
     * Validate the MIME type of a file upload attribute is in a set of MIME types.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array   $parameters
     * @return bool
     */
    protected function validateMimes($attribute, $value, $parameters)
    {
        if ( ! $this->isAValidFileInstance($value))
        {
            return false;
        }

        return $value->getPath() != '' && in_array($value->guessExtension(), $parameters);
    }


}
