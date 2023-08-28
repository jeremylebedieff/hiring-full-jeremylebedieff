<?php

declare(strict_types=1);

namespace Fulll\Domain\ParKing;

class Location
{
    /** @var string */
    private $floor;

    /** @var string */
    private $space;

    private $location;
    private $parkedLocations = [];

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function parkVehicle(string $location): void
    {
        if ($this->isVehicleParked($location)) {
            throw new \Exception('Vehicle is already parked at this location');
        }

        $this->parkedLocations[] = $location;
    }

    public function isVehicleParked(string $location): bool
    {
        return in_array($location, $this->parkedLocations);
    }

    public function __construct(string $floor, string $space)
    {
        $this->floor = $floor;
        $this->space = $space;
    }

    public function getFloor(): string
    {
        return $this->floor;
    }

    public function getSpace(): string
    {
        return $this->space;
    }

    public function __toString(): string
    {
        return $this->floor . '-' . $this->space;
    }
}
