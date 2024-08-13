<?php

declare(strict_types=1);

namespace Src\Model;

use Src\Model\Movie;
use Src\Model\Hall;

class Billboard 
{
    public function __construct(
        private int $id,
        private Movie $movie,
        private Hall $hall,
        private string $star_date,
        private string $end_date,
        private string $time_proyection
    ) {
    }

    public function jsonSerializeBillboard(): array
    {
        return[
            'id'=>$this->id,
            // 'movie_id'=>$this->movie_id,
            // 'hall_id'=>$this->hall_id,
            'movie'=>$this->movie->jsonSerializeMovie(),
            'hall'=>$this->hall->jsonSerializeHall(),
            'star_date'=>$this->star_date,
            'end_date'=>$this->end_date,
            'time_proyction'=>$this->time_proyection
    ];
    }

    
}
