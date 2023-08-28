<?php

declare(strict_types=1);

namespace Fulll\Domain\Fleet\ValueObject;

use InvalidArgumentException;

final class FleetId
{
    private int $id;

    public function __construct()
    {
        $this->id = random_int(1, PHP_INT_MAX);
        $this->validate();
    }

    public function equals(self $other): bool
    {
        return $this->id === $other->id;
    }

    public function validate(): void
    {
        if ($this->id <= 0) {
            throw new InvalidArgumentException('FleetId must be greater than 0.');
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isValid(): bool
    {
        return true;
    }
}
