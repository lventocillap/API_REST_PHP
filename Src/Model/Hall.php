<?php

declare(strict_types=1);

namespace Src\Model;

class Hall{

    PUBLIC function __construct(
        private int $id,
        private int $capacity,
        private bool $state
    )
    {

    }

    public function jsonSerializeHall():array
    {
            return[
                'id' => $this->id,
                'capacity' => $this->capacity,
                'state' => $this->state
            ];
    }
}