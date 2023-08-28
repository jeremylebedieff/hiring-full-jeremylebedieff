<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Fulll\Domain\ParKing\Location;
use Fulll\Domain\ParKing\ParkingLot;
use Fulll\Domain\Vehicle\Vehicle;
use Fulll\Helpers\GeneratePlateNumber;
use Fulll\Helpers\UniqueId;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\ExpectationFailedException;

class ParkVehicleContext implements Context
{
    /** @var Location */
    private $location;

    /** @var ParkingLot */
    private $parkingLot;

    /** @var Vehicle */
    private $vehicle;

    /**
     * @Given a location
     */
    public function aLocation(): void
    {
        $this->location = new Location('A789', '2');
    }

    /**
     * @When I park my vehicle at this location
     */
    public function iParkMyVehicleAtThisLocation(): void
    {
        $this->parkingLot = new ParkingLot(2);
        $this->vehicle = new Vehicle();
        $spaceNumber = $this->parkingLot->getSpaceNumber($this->location);
        $this->parkingLot->parkVehicle($spaceNumber, $this -> vehicle -> getId());
    }

    /**
     * @Then the known location of my vehicle should verify this location
     */
    public function theKnownLocationOfMyVehicleShouldVerifyThisLocation(): void
    {
        $parkedSpaceNumber = $this->parkingLot->getParkedSpaceNumber($this->vehicle->getVehicleId());
        $parkedLocation = $this->parkingLot->getSpaceLocation($parkedSpaceNumber);
        Assert::assertInstanceOf(Location::class, $parkedLocation);
        Assert::assertEquals($this->location, $parkedLocation);
    }



    /**
     * @Given my vehicle has been parked into this location
     */
    public function myVehicleHasBeenParkedIntoThisLocation(): void
    {
        $this->aLocation($this->location);
        $this->iParkMyVehicleAtThisLocation();
    }

    /**
     * @When I try to park my vehicle at this location
     */
    public function iTryToParkMyVehicleAtThisLocation(): void
    {
        $this->parkingLot = new ParkingLot(45);
        $this->vehicle = new Vehicle();
        $spaceNumber = $this->parkingLot->getSpaceNumber($this->location);
        $this->parkingLot->parkVehicle($spaceNumber, $this->vehicle->getId());

        try {
            $this->parkingLot->parkVehicle($spaceNumber, $this->vehicle->getId());
        } catch (\Exception $e) {
            Assert::assertEquals('This vehicle is already parked at this location', $e->getMessage());
        }
    }


    /**
     * @Then I should be informed that my vehicle is already parked at this location
     */
    public function iShouldBeInformedThatMyVehicleIsAlreadyParkedAtThisLocation(): void
    {
        $this->parkingLot = new ParkingLot(45);
        $this->vehicle = new Vehicle();
        $spaceNumber = $this->parkingLot->getSpaceNumber($this->location);
        $this->parkingLot->parkVehicle($spaceNumber, $this->vehicle->getId());

        try {
            $this->parkingLot->parkVehicle($spaceNumber, $this->vehicle->getId());
        } catch (\Exception $e) {
            if ($e->getMessage() !== 'This vehicle is already parked at this location') {
                throw new \Exception('Unexpected exception message');
            }

            return;
        }

        throw new \Exception('Expected exception was not thrown');
    }



}
