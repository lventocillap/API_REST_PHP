<?php

declare(strict_types=1);

namespace Src\Repository;

use PDO;
use PDOException;
use Src\Model\Movie;
use Src\Model\Billboard;
use Src\Database\Conexion;
use Src\Model\Hall;

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
            
            $movie = new Movie($fila['movie_id'], 
            $fila['title'],
            $fila['gender'],
            $fila['time'],
            $fila['premiere'],
            $fila['state']=1 ? true : false);
            
            $hall = new Hall($fila['hall_id'],
            $fila['capacity'],
            $fila['state']);

            $billboard = new Billboard($fila ['id'],
            $movie,
            $hall,
            $fila['star_date'],
            $fila['end_date'],
            $fila['time_proyection']);

            

            $billboards[] = [
                $billboard->jsonSerializeBillboard(),
                // 'MOVIE'=>$movie->jsonSerializeMovie(),
                // 'HALL'=>$hall->jsonSerializeHall()
            ];
        }
        return $billboards;
    }
}
