<?php
/**
 * Created by PhpStorm.
 * User: zjoia
 * Date: 3/7/17
 * Time: 9:20 AM
 */

namespace Kuali;

/*
 * The Building Class is set to house the banks of elevators and to allow for
 * scalability of the structure to multiple buildings with multiple banks of
 * elevators
 *
 * The building will also serve as a master controller for a bank of elevators
 *
 */

class Building
{
    /*+++++++++++++++++
    / Member Vars
    ++++++++++++++++++*/

    //Building Attributes
    private $name;

    //Building Associations
    private $floors;
    private $elevators;

    /*+++++++++++++++++
    / Constructor
    ++++++++++++++++++*/

    public function __construct($new_name)
    {
        $this->name = $new_name;
        $this->floors = array();
        $this->elevators = array();
    }

    /*+++++++++++++++++
    / Stubs | Interfaces
    ++++++++++++++++++*/

    public function setName($new_name)
    {
        return ($this->name = $new_name) ? true : false;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFloor(Floor $floor)
    {
        return $this->floors[$floor];
    }

    public function getFloors()
    {
        return $this->floors;
    }

    public function getElevator($id)
    {
        return $this->elevators[$id];
    }

    public function getElevators()
    {
        return $this->elevators;
    }

    public function addElevator(Elevator $elevator)
    {
        return ($this->elevators[] = $elevator) ? true : false;
    }

    // Remove elevator from bank controls when in Maint Mode
    public function removeElevator(Elevator $elevator)
    {
        if($elevator->isMaint){
            unset($this->elevators[$elevator]);
        }
    }


    // Get the floor numbers in reverse
    public function getFloorsReversed()
    {
        return array_reverse($this->getFloors());
    }

    // indicate to the elevator bank that a button has been pushed
    // and which direction was selected
    // an Action is sent from pressing the button and contains
    // action = "direction_floorNumber" : string
    public function buttonPressed($action)
    {
        $input = explode("_",$action);
        $direction = $input[1];
        $floorNumber = $input[2];

        foreach ($this->getFloors() as $floor)
        {
            if ($floor->getNumber() == $floorNumber)
            {
                $request = $direction == "up" ? $floor->getUpRequest() : $floor->getDownRequest();
                $request->setIsCalled(true);
                return;
            }
        }
    }

    // Identify the next step for the elevator bank
    public function nextStep()
    {
        foreach ($this->getElevators() as $elevator)
        {
            $this->moveElevator($elevator);
            $this->openDoors($elevator);
            if ($elevator->getIsMoving() || $elevator->getDoor() != 1)
            {
                continue;
            }

            //Manage people coming and going
        }
    }

    public function openDoors(Elevator $elevator)
    {
        if($elevator->getDoor() == 0)
        {
            $elevator->changeDoor();
        }
    }
    // Move the indicated elevator in the direction called
    public function moveElevator($elevator)
    {

    }
}