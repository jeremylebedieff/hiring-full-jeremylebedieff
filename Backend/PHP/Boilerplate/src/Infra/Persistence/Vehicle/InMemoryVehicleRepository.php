<?php

declare(strict_types=1);

namespace Fulll\Infra\Vehicle;

use Fulll\Domain\Vehicle\ValueObject\VehicleId;
use Fulll\Domain\Vehicle\Vehicle;
use Fulll\Domain\Vehicle\VehicleRepositoryInterface;

final class InMemoryVehicleRepository implements VehicleRepositoryInterface
{
    /** @var Vehicle[] */
    private array $vehicles = [];

    public function save(Vehicle $vehicle): void
    {
        $this->vehicles[$vehicle->getId()] = $vehicle;
    }

    public function findById(VehicleId $vehicleId): ?Vehicle
    {
        foreach ($this->vehicles as $vehicle) {
            if ($vehicle->getId()->equals($vehicleId)) {
                return $vehicle;
            }
        }
        return null;
    }


    public function findByPlateNumber(string $plateNumber): ?Vehicle
    {
        foreach ($this->vehicles as $vehicle) {
            if ($vehicle->getPlateNumber() === $plateNumber) {
                return $vehicle;
            }
        }
        return null;
    }

    public function findAll(): array
    {
        return array_values($this->vehicles);
    }

    public function remove(VehicleId $vehicleId): void
    {
        $this->vehicles = array_filter($this->vehicles, fn (Vehicle $vehicle) => !$vehicle->getId()->equals($vehicleId));
    }

}
