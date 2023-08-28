<?php

declare(strict_types=1);

namespace Fulll\Domain\Vehicle;

use Fulll\Domain\Vehicle\ValueObject\VehicleId;

interface VehicleRepositoryInterface
{
    public function save(Vehicle $vehicle): void;

    public function remove(VehicleId $vehicleId): void;

    public function findById(VehicleId $vehicleId): ?Vehicle;

    public function findByPlateNumber(string $plateNumber): ?Vehicle;

    public function findAll(): array;
}
