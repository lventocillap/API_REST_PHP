<?php 

declare(strict_types=1);

namespace Src\Controller;

use Src\Model\Billboard;
use Src\Repository\MovieRepository;
use Src\Repository\InnerMovieBillboard;
use Src\Repository\InsertDetailSale;
use Src\Repository\SeatAvalaible;

class MovieController{

    public function __construct(
        private MovieRepository $movieRepository,
        private InnerMovieBillboard $inner,
        private SeatAvalaible $seats,
        private InsertDetailSale $insertDetailSale
    )
    {
    }

    public function index(): void
    {
        $movies = $this->movieRepository->getAll();
        $inner = $this->inner->innerTables();
        

        echo json_encode($inner,JSON_PRETTY_PRINT);
    }

    public function filterBillboardSeat($id): void
    {
        $seats = $this->seats->seatAvalaible($id);
        // $movieId = $this->movieRepository->getById($id)->jsonSerializeMovie();

        echo json_encode($seats,JSON_PRETTY_PRINT);
    }

    public function newMovie():void
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $this->movieRepository->insertMovie(
            $data['title'],$data['gender'],$data['time'],$data['premiere'],$data['state']);
        // echo json_encode(['message'=>'movie create sucessfutty']);
    }

    public function upMovie(int $id): void
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $this->movieRepository->updateMovie(
            $id,$data['title'],$data['gender'],$data['time'],$data['premiere'],$data['state']);
    }

    public function deleMovie(int $id): void
    {
        $this->movieRepository->deleteMovie($id);
    }

    public function insertDetailSale(): void
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        foreach($data['seates'] as $seat_id){
            $seat = $this->seats->getSeat($seat_id);
            $seats[] = $seat->jsonSerializeSeat();
        }

        $this->insertDetailSale->insertDetailSale(
            $data['sale_id'], $data['billboard_id'], $seats, $data['price']
        );   
    }

    
}