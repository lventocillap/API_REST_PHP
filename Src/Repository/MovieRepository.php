<?php

declare(strict_types=1);

namespace Src\Repository;

use PDO;
use PDOException;
use Src\Database\Conexion;
use Src\Model\Movie;

class MovieRepository
{

    public function __construct() {}

    public function getAll(): array
    {
        $conexion = new Conexion;
        $PDO = $conexion->getConexion();
        foreach ($PDO->query('SELECT * from movie') as $fila) {
            $movies[] = $fila;
        }
        return $movies;
    }

    public function getById(int $id): Movie
    {
        $conexion = new Conexion();
        $PDO = $conexion->getConexion();

        $stmt = $PDO->prepare('SELECT * FROM movie WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Movie(
            $movie['id'],
            $movie['title'],
            $movie['gender'],
            $movie['time'],
            $movie['premiere'],
            $movie['state'] === 1 ? true : false
        );
    }

    public function updateMovie(int $id, string $title, string $gender, string $time, string $premiere, bool $state): void
    {
        $conexion = new Conexion();
        $PDO = $conexion->getConexion();
        try {

            $stmt = $PDO->prepare('UPDATE movie SET 
        title = :title, 
        gender = :gender,
        time = :time,
        premiere = :premiere,
        state = :state
        WHERE id = :id');

            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
            $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            $stmt->bindParam(':premiere', $premiere, PDO::PARAM_STR);
            $stmt->bindParam(':state', $state, PDO::PARAM_BOOL);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            echo "Actualizado!!!";
        } catch (PDOException $e) {
            echo "Error !!! :" . $e->getMessage();
        }
    }

    public function insertMovie(string $title, string $gender, string $time, string $premiere, bool $state): void
    {
        $conexion = new Conexion();
        $PDO = $conexion->getConexion();
        try {

            $stmt = $PDO->prepare('INSERT INTO movie(title, gender, time, premiere, state) 
        VALUES( 
        :title, 
        :gender,
        :time,
        :premiere,
        :state
        )');

            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
            $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            $stmt->bindParam(':premiere', $premiere, PDO::PARAM_STR);
            $stmt->bindParam(':state', $state, PDO::PARAM_BOOL);
            $stmt->execute();

            echo "Se inserto una nueva pelicula!!!";
        } catch (PDOException $e) {
            echo "Error !!! :" . $e->getMessage();
        }
    }

    public function deleteMovie(int $id):void
    {
        $conexion = new Conexion;
        $PDO = $conexion->getConexion();
        try{
            $stmt = $PDO->prepare('DELETE FROM movie WHERE id = :id');

            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

            $stmt->execute();

            echo "Se borro el id : $id";
        }catch(PDOException $e){
            echo "ERROR : ".$e->getMessage();
        }
    }
}
