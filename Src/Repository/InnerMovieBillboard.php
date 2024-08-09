<?php

declare(strict_types=1);

namespace Src\Repository;

use PDO;
use PDOException;
use Src\Model\Movie;
use Src\Model\Billboard;
use Src\Database\Conexion;

class InnerMovieBillboard
{

    public function __construct() {}

    public function innerTables() : array
    {
        $conexion = new Conexion();
        $PDO = $conexion->getConexion();
        foreach($PDO->query('select * from billboard b 
        inner join movie m 
        on b.movie_id = m.id
        inner join hall h
        on b.hall_id = h.id') as $fila){
            $movies[] = $fila;
        }
        return $movies;
    }
}
