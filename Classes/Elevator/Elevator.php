<?php
/**
 * Created by PhpStorm.
 * User: zjoia
 * Date: 3/7/17
 * Time: 9:26 AM
 */

namespace Kuali;

/*
 * The Elevator Class is set to contol the individual action of an elevator
 * to track it's movement and progress and to identify where in a building
 * it is and if it's occupied or not.
 *
 * An elevator will also trigger it's own need for maintenance;
 */

class Elevator
{
    /*+++++++++++++++++
    / Member Vars
    ++++++++++++++++++*/

    //Elevator Attributes
    private $direction;
    private $isMoving;
    //Door open = 1, Door closed = 0
    private $door;

    //Elevator Associations
    private $requestedFloors;
    private $passengers;
    private $building;
    private $floor;
    private $trips;
    private $isMaint;

    /*+++++++++++++++++
    / Constructor
    ++++++++++++++++++*/

    public function __construct($aDirection, $aIsMoving, $aBuilding)
    {
        $this->direction = $aDirection;
        $this->isMoving = $aIsMoving;
        $this->percentageDoorOpen = 0;
        $this->requestedFloors = array();
        $this->passengers = array();
        $this->trips = 0;
        $this->door = 0;
        $this->isMaint = 0;
        $didAddBuilding = $this->setBuilding($aBuilding);
        if (!$didAddBuilding)
        {
            throw new Exception("Unable to create elevator due to building");
        }
    }

    /*+++++++++++++++++
    / Stubs | Interfaces
    ++++++++++++++++++*/

    public function setDirection($dir)
    {
        return $this->direction = $dir ? true : false;
    }

    public function setIsMoving($move)
    {
        return $this->isMoving = $move ? true : false;
    }

    public function getDoor()
    {
        return $this->door;
    }

    public function changeDoor()
    {
        $this->door = ($this->door) ? 0 : 1;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function getIsMoving()
    {
        return $this->isMoving;
    }

    public function getRequestedFloor($floorNum)
    {
        $RequestedFloor = $this->requestedFloors[$floorNum];
        return $RequestedFloor;
    }

    public function getRequestedFloors()
    {
        $allReqFloors = $this->requestedFloors;
        return $allReqFloors;
    }

    public function numberOfRequestedFloors()
    {
        $number = count($this->requestedFloors);
        return $number;
    }

    public function hasRequestedFloors()
    {
        $has = $this->numberOfRequestedFloors() > 0;
        return $has;
    }

    public function getPassenger($peep)
    {
        $passenger= $this->passengers[$peep];
        return $passenger;
    }

    public function getPassengers()
    {
        $allPassengers = $this->passengers;
        return $allPassengers;
    }

    public function passengerCount()
    {
        $number = count($this->passengers);
        return $number;
    }

    public function hasPassengers()
    {
        $has = $this->passengerCount() > 0;
        return $has;
    }

    public function getBuilding()
    {
        return $this->building;
    }

    public function getFloor()
    {
        return $this->floor;
    }


    public function addRequestedFloor($requestedFloor)
    {
        return ($this->requestedFloors[] = $requestedFloor) ? true : false;
    }

    public function removeRequestedFloor($requestedFloor)
    {
        unset($this->requestedFloors[$requestedFloor]);
    }

    public function addPassenger($peep)
    {
        return ($this->passenger[] = $peep) ? true : false;
    }

    public function removePassenger($bye_peep)
    {
        unset($this->passenger[$bye_peep]);
    }

    public function addTrip()
    {
        $this->trips++;
    }

    public function resetTrips()
    {
        $this->trips = 0;
    }

    public function setFloor(Floor $floor)
    {
        if ($floor == null)
        {
            $existingFloor = $this->floor;
            $this->floor = null;

            if ($existingFloor != null && $existingFloor->getElevatorOnThisFloor() != null)
            {
                $existingFloor->setElevatorOnThisFloor(null);
            }
            return true;
        }

        $currentFloor = $this->getFloor();
        if ($currentFloor != null && $currentFloor != $floor)
        {
            $currentFloor->setElevatorOnThisFloor(null);
        }

        $this->floor = $floor;
        $existingElevatorOnThisFloor = $floor->getElevatorOnThisFloor();

        if ($this != $existingElevatorOnThisFloor)
        {
            $floor->setElevatorOnThisFloor($this);
        }
        return true;
    }

    public function switchDirections()
    {
        $this->setDirection($this->getDirection() == "up" ? "down" : "up");
    }

    public function isUp()
    {
        return $this->getDirection() == "up";
    }

    public function isDown()
    {
        return $this->getDirection() == "down";
    }
}