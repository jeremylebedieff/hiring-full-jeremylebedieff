<?php

declare(strict_types=1);

namespace Fulll\Domain\Vehicle\ValueObject;

use InvalidArgumentException;
use Fulll\Helpers\GeneratePlateNumber;

class VehiclePlateNumber
{
    private GeneratePlateNumber $plateNumber;

    public function __construct()
    {
        $this->plateNumber = new GeneratePlateNumber();
        $this->validate();
    }

    public function __toString(): string
    {
        return (string) $this->plateNumber;
    }

    public function equals(self $other): bool
    {
        return $this->plateNumber->equals($other->plateNumber);
    }

    private function validate(): void
    {
        if (!$this->plateNumber->isValid()) {
            throw new InvalidArgumentException('Invalid plate number format');
        }
    }
}