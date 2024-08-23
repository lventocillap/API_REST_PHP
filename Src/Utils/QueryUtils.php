<?php

declare(strict_types=1);

namespace Src\Utils;

class QueryUtils
{
    public static function query(string $parameter, ?string $undefinead = NULL): ?string
    {
        if(isset($_GET[$parameter])){
            $param = $_GET[$parameter];
            return $param;
        }else{
            return $undefinead;
        }
    }
}