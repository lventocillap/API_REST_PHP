<?php

use Src\Controller\MovieController;
use Src\Repository\InnerMovieBillboard;
use Src\Repository\InsertDetailSale;
use Src\Repository\MovieRepository;
use Src\Repository\SeatAvalaible;
use Src\Utils\QueryUtils;

// Cargar el autoloading si estás usando Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Crear instancias necesarias
$movie = new MovieRepository();
$inner = new InnerMovieBillboard();
$seats = new SeatAvalaible();
$insertSeats = new InsertDetailSale($seats);
$queryUtils = new QueryUtils();

$dato = new MovieController($movie, $inner, $seats, $insertSeats, $queryUtils);

return [
  'GET' => [
    'movie' => function () use ($dato) {

      if(QueryUtils::query('title') !== NULL){
        $dato->getParamsMovie();
      }else{
        $dato->index();
      }
    },
    'seat' => function () use ($dato) {
      
    },
    'billboard' => function () use ($dato) {
      
    },
    'hall' => function () use ($dato) {
      
    },
    'billboard/{id}/seat' => function ($movieId) use ($dato) {
      $dato->filterBillboardSeat((int)$movieId);
    },
  ],
  'POST' => [
    'movie' => function () use ($dato) {
      $dato->newMovie();
    },
    'detail_sale' => function () use ($dato) {
      $dato->insertDetailSale();
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