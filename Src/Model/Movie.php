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

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    public function getPremiere(): string
    {
        return $this->premiere;
    }

    public function setPremiere(string $premiere): void
    {
        $this->premiere = $premiere;
    }

    public function getState(): bool
    {
        
        return $this->state;
    }

    public function setState(bool $state): void
    {
        $this->state = $state;
    }

    

    public function jsonSerializeMovie(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'gender' => $this->gender,
            'time' => $this->time,
            'premiere' =>$this->premiere,
            'status' => $this->state
        ];
    }
}
