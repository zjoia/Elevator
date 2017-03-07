<?php
/**
 * Created by PhpStorm.
 * User: zjoia
 * Date: 3/7/17
 * Time: 10:12 AM
 */

namespace Kuali;


class Floor
{

    /*+++++++++++++++++
    / Static Vars
    ++++++++++++++++++*/

    private static $nextFloor = 1;

    /*+++++++++++++++++
    / Member Vars
    ++++++++++++++++++*/

    //Floor Attributes
    private $number;

    //Floor Associations
    private $waitingPeeps;
    private $elevatorHere;
    public  $request;
    private $building;
    private $goingTo;
    private $exitPeeps;

    /*+++++++++++++++++
    / Constructor
    ++++++++++++++++++*/

    public function __construct($aBuilding)
    {
        $this->number = self::$nextFloor++;
        $this->waitingPeeps = array();
        $didAddBuilding = $this->setBuilding($aBuilding);
        if (!$didAddBuilding)
        {
            throw new Exception("Unable to create floor due to building");
        }
        $this->exitPeeps = array();
    }

    /*+++++++++++++++++
    / Stubs | Interfaces
    ++++++++++++++++++*/

    public function getNumber()
    {
        return $this->number;
    }

    public function getWaitingPerson($peep)
    {
        $waitingPeep = $this->waitingPeeps[$peep];
        return $waitingPeep;
    }

    public function getWaitingPersons()
    {
        $newPeeps = $this->waitingPeeps;
        return $newPeeps;
    }

    public function numberOfWaitingPersons()
    {
        $number = count($this->waitingPeeps);
        return $number;
    }

    public function hasWaitingPeeps()
    {
        $has = $this->numberOfWaitingPeeps() > 0;
        return $has;
    }

    public function indexOfWaitingPerson($peep)
    {
        $index = array_search($peep,$this->waitingPeeps);
        return $index;
    }

    public function getElevatorOnThisFloor()
    {
        return $this->elevatorHere;
    }

    public function getRequest()
    {
        return $this->Request;
    }


    public function getBuilding()
    {
        return $this->building;
    }

    public function getOnItsWayTo()
    {
        return $this->goingTo;
    }

    public function getExitAtPerson($index)
    {
        $aExitAtPerson = $this->exitPeeps[$index];
        return $aExitAtPerson;
    }

    public function getExitAtPersons()
    {
        $newExitAtPersons = $this->exitPeeps;
        return $newExitAtPersons;
    }

    public function numberOfExitPeeps()
    {
        $number = count($this->exitPeeps);
        return $number;
    }

    public function hasExitAtPersons()
    {
        $has = $this->numberOfExitPeeps() > 0;
        return $has;
    }

    public function indexOfExitAtPerson($exitPeep)
    {
        $index = array_search($exitPeep, $this->exitPeeps);
        return $index;
    }

    public function addWaitingPeep($waitingPeep)
    {
        //Add that a person is waiting on this floor
    }

    public function removeWaitingPeep($waitingPeep)
    {
        //indicate that the peep is no longer waiting
    }

    public function setElevatorOnThisFloor(Elevator $newElevatorOnThisFloor)
    {
        //Check if there is an elevator on this floor

        //Set the new elevator to this floor

    }

    public function setRequest($newRequest)
    {
        //new request set

        //make sure not to we can fulfill the request

        //bind Request and direction to this floor

    }



    public function setOnItsWayTo($aOnItsWayTo)
    {

    }

    public function addExitAtPerson($aExitAtPerson)
    {
        //indicate that a person is leaving on this floor
    }

    public function removeExitAtPerson($aExitAtPerson)
    {
        //remove the peep from the elevator queue
    }
}