<?php

declare(strict_types=1);

namespace Fulll\Domain\Vehicle\ValueObject;

use InvalidArgumentException;

final class VehicleId
{
    private int $id;

    public function __construct(int $id)
    {
        if ($id < 1) {
            throw new InvalidArgumentException('VehicleId must be a positive integer.');
        }

        $this->id = $id;
    }

    public static function generate(): int
    {
        // Générer un identifiant unique pour chaque véhicule en utilisant la fonction uniqid() de PHP
        $id =  uniqid();
        // Conversion de l'identifiant en entier
        $id = intval($id);
        return $id;

    }


    public function getInt(): int
    {
        return $this->id;
    }

    public function equals(self $other): bool
    {
        return $this->id === $other->id;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

    public function toSting(): string
    {
        return (string) $this->id;
    }


}
