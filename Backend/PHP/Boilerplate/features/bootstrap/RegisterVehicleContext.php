<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Fulll\Domain\Fleet\Fleet;
use Fulll\Domain\Vehicle\Vehicle;
use Fulll\Domain\Vehicle\ValueObject\VehicleId;
use Fulll\Domain\Vehicle\ValueObject\VehiclePlateNumber;

class RegisterVehicleContext implements Context
{
    private Fleet $myFleet;
    private Vehicle $vehicle;
    private VehicleId $vehicleId;
    private VehiclePlateNumber $vehiclePlateNumber;
    private string $location;
    private Fleet $otherUserFleet;

    /**
     * @Given my fleet
     */
    public function myFleet()
    {
        $this->myFleet = new Fleet();
    }

    /**
     * @Given a vehicle
     */
    public function aVehicle()
    {
        $this->vehicle = new Vehicle();
    }

    /**
     * @When I register this vehicle into my fleet
     */
    public function iRegisterThisVehicleIntoMyFleet(): void
    {
        try {
            $this->myFleet->addVehicle($this->vehicle);
            $this->vehicleHasBeenRegisteredIntoMyFleet = true;
        } catch (\Exception $e) {
            throw new \Exception('Vehicle is already part of fleet', 0, $e);
        }
    }

    /**
     * @Then this vehicle should be part of my vehicle fleet
     */
    public function thisVehicleShouldBePartOfMyVehicleFleet(): void
    {
        if (!$this->vehicleHasBeenRegisteredIntoMyFleet) {
            throw new \Exception('Vehicle has not been registered into my fleet');
        }

        if (!$this->myFleet->hasVehicle($this->vehicle)) {
            throw new \Exception('Vehicle is not part of my fleet');
        }
    }

    /**
     * @Given I have registered this vehicle into my fleet
     */
    public function iHaveRegisteredThisVehicleIntoMyFleet(): void
    {
        $this->myFleet->addVehicle($this->vehicle);
        $this->vehicleHasBeenRegisteredIntoMyFleet = true;
    }


    /**
     * @When I try to register this vehicle into my fleet
     */
    public function iTryToRegisterThisVehicleIntoMyFleet(): void
    {
        try {
            $this->myFleet->addVehicle($this->vehicle);
            $this->vehicleHasBeenRegisteredIntoMyFleet = true;
        }
        catch (\Exception $e) {
            $this->vehicleHasBeenRegisteredIntoMyFleet = false;
        }
    }

    /**
     * @Then I should be informed this this vehicle has already been registered into my fleet
     */
    public function iShouldBeInformedThisThisVehicleHasAlreadyBeenRegisteredIntoMyFleet(): void
    {
        if ($this->vehicleHasBeenRegisteredIntoMyFleet) {
            throw new \Exception('Vehicle has already been registered into my fleet');
        }
    }

    /**
     * @Given the fleet of another user
     */
    public function theFleetOfAnotherUser()
    {
        // Create a fake fleet for user 1
        $numberPlate1 = new VehiclePlateNumber();
        $vehicle1 = new Vehicle();
        $fleet1 = new Fleet();
        $fleet1->addVehicle($vehicle1);
        $this->fleets[1] = $fleet1;

        // Create a fake fleet for user 2
        $numberPlate2 = new VehiclePlateNumber();
        $vehicle2 = new Vehicle();
        $fleet2 = new Fleet();
        $fleet2->addVehicle($vehicle2);
        $this->fleets[2] = $fleet2;
    }

    /**
     * @Given the other user has a fleet with a vehicle
     */
    public function theOtherUserHasAFleetWithAVehicle(): void
    {
        $this->otherUserFleet = new Fleet();
        $this->otherUserFleet->addVehicle($this->vehicle);
    }

    /**
     * @Given this vehicle has been registered into the other user's fleet
     */
    public function thisVehicleHasBeenRegisteredIntoTheOtherUsersFleet(): void
    {
        $this->otherUserFleet = new Fleet();
        $this->otherUserFleet->addVehicle($this->vehicle);
        $this->vehicleHasBeenRegisteredIntoOtherUsersFleet = true;
    }


}
