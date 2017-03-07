<?php
/**
 * Created by PhpStorm.
 * User: zjoia
 * Date: 3/7/17
 * Time: 10:13 AM
 */

namespace Kuali;


class Request
{
    /*+++++++++++++++++
    / Member Vars
    ++++++++++++++++++*/

    //Request Associations
    private $floor;
    private $isCalled;
    private $direction;

    /*+++++++++++++++++
    / Constructor
    ++++++++++++++++++*/
    public function __construct($isCalled, $floor)
    {
        $this->isCalled = 0;
        $addFloor = $this->setFloor($floor);
        if (!$addFloor)
        {
            throw new Exception("Unable to create Request due to no floor");
        }
    }

    /*+++++++++++++++++
    / Stubs | Interfaces
    ++++++++++++++++++*/

    public function getFloor()
    {
        return $this->floor;
    }

    public function setFloor($floor)
    {
        if ($floor == null)
        {
            return false;
        }

        $existingRequest = $floor->getRequest();
        if ($existingRequest != null && $this != $existingRequest)
        {
            return false;
        }

        $oldFloor = $this->floor;

        $this->floor = $floor;

        $this->floor->setRequest($this);

        if ($oldFloor != null)
        {
            $oldFloor->setRequest(null);
        }

        return true;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    public function setIsCalled($isCalled)
    {
        $this->isCalled = $isCalled;
    }
    public function getIsCalled()
    {
        return $this->isCalled;
    }

}