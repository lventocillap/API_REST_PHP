<?php 

declare(strict_types=1);

namespace Src\Controller;


use Src\Repository\MovieRepository;
use Src\Repository\InnerMovieBillboard;

class MovieController{

    public function __construct(

        private MovieRepository $movieRepository,
        private InnerMovieBillboard $inner
    )
    {
    }

    public function index(): void
    {
        $movies = $this->movieRepository->getAll();
        $inner = $this->inner->innerTables();

        echo json_encode($inner,JSON_PRETTY_PRINT);
    }

    public function filterMovie($id): void
    {
        $movieId = $this->movieRepository->getById($id)->jsonSerializeMovie();
        echo json_encode($movieId,JSON_PRETTY_PRINT);
    }

    public function newMovie():void
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $this->movieRepository->insertMovie(
            $data['title'],$data['gender'],$data['time'],$data['premiere'],$data['state']);
        // echo json_encode(['message'=>'movie create sucessfutty']);
    }

    public function upMovie($id): void
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $this->movieRepository->updateMovie(
            $id,$data['title'],$data['gender'],$data['time'],$data['premiere'],$data['state']);
    }

    public function deleMovie($id): void
    {
        $this->movieRepository->deleteMovie($id);
    }
}