<?php

declare(strict_types=1);

namespace Fulll\Infra\Fleet;

use Fulll\Domain\Fleet\Fleet;
use Fulll\Domain\Fleet\FleetRepositoryInterface;
use Fulll\Domain\Fleet\ValueObject\FleetId;
use Fulll\Domain\Vehicle\Vehicle;

final class InMemoryFleetRepository implements FleetRepositoryInterface
{
    /** @var Fleet[] */
    private array $fleets = [];

    public function save(Fleet $fleet): void
    {
        $this->fleets[$fleet->getId()->isValid()] = $fleet;
    }

    public function findById(FleetId $fleetId): ?Fleet
    {
        return $this->fleets[$fleetId->isValid()] ?? null;
    }

    public function findByOwnerId(int $ownerId): ?array
    {
        return array_filter($this->fleets, fn (Fleet $fleet) => $fleet->getOwnerId() === $ownerId);
    }

    /**
     * @param int $vehicleId
     * @return Vehicle|null
     */
    public function getVehicleById(int $vehicleId): ?Vehicle
    {
        foreach ($this->fleets as $fleet) {
            foreach ($fleet->getVehicles() as $vehicle) {
                if ($vehicle->getId() === $vehicleId) {
                    return $vehicle;
                }
            }
        }

        return null;
    }
}
