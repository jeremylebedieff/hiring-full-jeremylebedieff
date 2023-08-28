<?php

namespace Fulll\Domain\Fleet;

use Fulll\Domain\Fleet\ValueObject\FleetId;
use Fulll\Domain\Vehicle\Vehicle;

interface FleetRepositoryInterface
{
    public function save(Fleet $fleet): void;

    public function findById(FleetId $fleetId): ?Fleet;

    public function findByOwnerId(int $ownerId): ?array;

    public function getVehicleById(int $vehicleId): ?Vehicle;
}
