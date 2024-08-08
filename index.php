<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Src\Database\Conexion;
use Src\Repository\MovieRepository;

header('Content-Type: application/json; charset=utf-8');

$movie = new MovieRepository();

$movies = $movie->getAll();
$movieID = $movie->getById(1);

// $movie->updateMovie(1, 'Deedpool', 'Violence', '02:28:00', '2010-07-16', false);

// $movie->inserMovie('Minions', 'Animation', '02:28:00', '2010-07-16', true);

// $movie->deleteMovie(13);


// echo json_encode($movieID->jsonSerialize(), JSON_PRETTY_PRINT);

echo json_encode($movies, JSON_PRETTY_PRINT);