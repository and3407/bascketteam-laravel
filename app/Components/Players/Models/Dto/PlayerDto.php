<?php

namespace App\Components\Players\Models\Dto;

class PlayerDto
{
    private int $userId;
    private string $name;
    private bool $high;
    private bool $active;

    public function __construct(
        int $userId,
        string $name,
        bool $high,
        bool $active
    ) {
        $this->userId = $userId;
        $this->name = $name;
        $this->high = $high;
        $this->active = $active;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isHigh(): bool
    {
        return $this->high;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}
