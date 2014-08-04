<?php

namespace MindOfMicah\Modules;

use Illuminate\Filesystem\Filesystem;

class PathValidator
{
    public function __construct(Filesystem $file)
    {
        $this->file = $file;
    }

    public function validate($file)
    {
        $segments = explode(DIRECTORY_SEPARATOR, $file);
        array_pop($segments);
        if (!$this->file->isDirectory(implode(DIRECTORY_SEPARATOR, $segments))) {

            $this->file->makeDirectory(implode(DIRECTORY_SEPARATOR, $segments), 0777, true);
        }
    }
}
