<?php

declare(strict_types=1);

namespace Src\Excception;

use Exception;
class MovieException extends Exception
{
    public function __construct(){
        parent::__construct("Movie not found", 404);
    }
}