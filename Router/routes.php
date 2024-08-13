<?php

use Src\Controller\MovieController;
use Src\Repository\InnerMovieBillboard;
use Src\Repository\MovieRepository;


// Cargar el autoloading si estás usando Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Crear instancias necesarias
$movie = new MovieRepository();
$inner = new InnerMovieBillboard();

$dato = new MovieController($movie, $inner);

return [
  'GET' => [
    'movie' => function () use ($dato) {
      $dato->index();
    },
    'movie/{id}' => function ($movieId) use ($dato) {
      $dato->filterMovie((int)$movieId);
    }
  ],
  'POST' => [
    'movie' => function () use ($dato) {
      $dato->newMovie();
    },
  ],

  'PUT' => [
      'movie/{id}' => function ($movieId) use ($dato){
        $dato->upMovie((int)$movieId);
      },
  ],
  'DELETE' => [
    'movie/{id}' => function ($movieId) use ($dato) {
      $dato->deleMovie((int)$movieId);
    },
  ],
];