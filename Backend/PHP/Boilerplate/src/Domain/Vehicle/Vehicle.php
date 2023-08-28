<?php

declare(strict_types=1);

namespace Fulll\Domain\Vehicle;

use Fulll\Domain\ParKing\Location;
use Fulll\Domain\Vehicle\ValueObject\VehicleId;
use Fulll\Domain\Vehicle\ValueObject\VehiclePlateNumber;


use Stringable;

final class Vehicle implements Stringable
{
    private VehicleId $vehicleId;
    private int $id;
    private VehiclePlateNumber $plateNumber;
    private ?Location $location = null;

    public function __construct()
    {

        $this->id = VehicleId::generate();
        $this->plateNumber = new VehiclePlateNumber();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPlateNumber(): VehiclePlateNumber
    {
        return $this->plateNumber;
    }

    public function equals(self $other): bool
    {
        return $this->id === $other->id;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function getInteger(): int
    {
        return $this->id;
    }

    public function toSting(): string
    {
        return (string) $this->id;
    }

    public function getVehicleId(): VehicleId
    {
        $this->vehicleId = uniqid();
        return $this->vehicleId;
    }

}
