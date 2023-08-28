<?php

declare(strict_types=1);

namespace Fulll\Domain\Fleet;

use Fulll\Domain\Fleet\ValueObject\FleetId;
use Fulll\Domain\Vehicle\Vehicle;
use Fulll\Domain\Vehicle\ValueObject\VehicleId;

final class Fleet
{
    private FleetId $id;
    private array $vehicles;
    private int $ownerId;

    public function __construct()
    {
        $this->id = new FleetId();
        $this->validate();
        $this->vehicles = [];
        $this->ownerId = $this->generateOwnerId();
    }
    public function getId(): FleetId
    {
        return $this->id;
    }

    public function validate(): void
    {
        if (!$this->id->isValid()) {
            throw new \InvalidArgumentException('Invalid id format');
        }
    }

    public function isValid(): bool
    {
        return $this->id->isValid();
    }

    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): void
    {
        if (in_array($vehicle, $this->vehicles)) {
            throw new \InvalidArgumentException('This vehicle is already registered in the fleet');
        }

        $this->vehicles[] = $vehicle;
    }

    public function hasVehicle(Vehicle $vehicle): bool
    {
        foreach ($this->vehicles as $fleetVehicle) {
            if ($fleetVehicle->getId() === $vehicle->getId()) {
                return true;
            }
        }
        return false;
    }


    public function removeVehicle(VehicleId $vehicleId): void
    {
        $this->vehicles = array_filter($this->vehicles, function (Vehicle $vehicle) use ($vehicleId) {
            return !$vehicle->getId()->equals($vehicleId);
        });
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    public function equals(self $other): bool
    {
        return $this->id === $other->id;
    }

    public function generateOwnerId(): int
    {
        return $this->ownerId = rand(1, 100);
    }
}
