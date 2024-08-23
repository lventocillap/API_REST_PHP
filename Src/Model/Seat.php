<?php

declare(strict_types=1);

namespace Src\Model;

class Seat
{
    public function __construct(
        private int $id,
        private string $nro_seat,
        private bool $state 
    )
    {
        
    }

    public function jsonSerializeSeat():array
    {
        return[
            'id'=>$this->id,
            'nro_seat'=>$this->nro_seat,
            'status'=>$this->state 
        ];
    }
}