<?php

namespace Fulll\Domain\ParKing;

use Fulll\Domain\Vehicle\ValueObject\VehicleId;

final class ParkingLot
{
    private array $parkingSpaces;
    private $spaces;

    public function __construct(int $numberOfSpaces)
    {
        $this->parkingSpaces = array_fill(0, $numberOfSpaces, null);
    }

    public function parkVehicle(int $spaceNumber, int $vehicleId): bool
    {
        if (isset($this->parkingSpaces[$spaceNumber])) {
            return false;
        }

        $this->parkingSpaces[$spaceNumber] = $vehicleId;
        return true;
    }

    public function unParkVehicle(int $spaceNumber): bool
    {
        if (!isset($this->parkingSpaces[$spaceNumber])) {
            return false;
        }

        $this->parkingSpaces[$spaceNumber] = null;
        return true;
    }

    public function isSpaceAvailable(int $spaceNumber): bool
    {
        return !isset($this->parkingSpaces[$spaceNumber]);
    }

    public function getNumberOfSpaces(): int
    {
        return count($this->parkingSpaces);
    }

    public function getOccupiedSpaces(): array
    {
        $occupiedSpaces = [];
        foreach ($this->parkingSpaces as $spaceNumber => $vehicleId) {
            if (isset($vehicleId)) {
                $occupiedSpaces[] = $spaceNumber;
            }
        }

        return $occupiedSpaces;
    }

    public function getSpaceNumber(Location $location): int
    {
        $spaceNumber = 0;
        foreach ($this->parkingSpaces as $spaceNumber => $vehicleId) {
            if (isset($vehicleId)) {
                $occupiedSpaces[] = $spaceNumber;
            }
        }

        return $spaceNumber;
    }

    public function getVehicleId(int $spaceNumber): string
    {
        return $this->parkingSpaces[$spaceNumber];
    }

    public function getLocation(VehicleId $vehicleId): ?Location
    {
        $spaceNumber = array_search($vehicleId, $this->parkingSpaces, true);
        if ($spaceNumber === false) {
            return null;
        }
        $numberOfSpaces = $this->getNumberOfSpaces();
        return new Location($spaceNumber + 1, $numberOfSpaces);
    }

    public function getParkedSpaceNumber(VehicleId $vehicleId): ?int
    {
        foreach ($this->spaces as $spaceNumber => $parkedVehicleId) {
            if ($vehicleId === $parkedVehicleId) {
                return $spaceNumber;
            }
        }
        return null;
    }
}








