<?php

declare(strict_types=1);

namespace Src\Model;

class Billboard
{
    public function __construct(
        private int $id,
        private int $movie_id,
        private int $hall_id,
        private string $star_date,
        private string $end_date,
        private string $time_proyection
    ) {
    }

    public function jsonSerializableBillboard(): array
    {
        return[
            'id'=>$this->id,
            'movie_id'=>$this->movie_id,
            'hall_id'=>$this->hall_id,
            'star_date'=>$this->star_date,
            'end_date'=>$this->end_date,
            'time_proyction'=>$this->time_proyection
    ];
    }

    
}
