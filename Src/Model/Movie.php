<?php

declare(strict_types=1);

namespace Src\Model;

class Movie
{

    public function __construct(
        private int $id,
        private string $title,
        private string $gender,
        private string $time,
        private string $premiere,
        private bool $state,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getPremiere(): string
    {
        return $this->premiere;
    }

    public function getState(): bool
    {
        
        return $this->state;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'gender' => $this->gender,
            'time' => $this->time,
            'premiere' =>$this->premiere,
            'state' => $this->state
        ];
    }
}
