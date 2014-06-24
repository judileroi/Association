<?php

namespace Ben\AssociationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ben\AssociationBundle\Entity\Rooms
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ben\AssociationBundle\Entity\RoomsRepository")
 */
class Rooms
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $number
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var integer $floor
     *
     * @ORM\Column(name="floor", type="integer")
     */
    private $floor;

    /**
     * @var integer $max_persons
     *
     * @ORM\Column(name="max_persons", type="integer")
     */
    private $max_persons;

    /**
     * @var integer $available
     *
     * @ORM\Column(name="available", type="integer")
     */
    private $available;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    
    /**
    * @ORM\ManyToOne(targetEntity="Ben\AssociationBundle\Entity\Hotels",inversedBy="rooms")
    * @ORM\JoinColumn(name="hotel_id",referencedColumnName="id", nullable=false)
    * @Assert\Valid()
    */
    private $hotel;
    
    /**
    * @ORM\OneToMany(targetEntity="Ben\AssociationBundle\Entity\Reservation",mappedBy="room", cascade={"remove", "persist"})
    */
    private $reservations;
    
    /************ constructeur ************/
    
    public function __construct()
    {
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /************ getters & setters  ************/

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return room
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set max_persons
     *
     * @param integer $max_persons
     * @return room
     */
    public function setMaxPersons($max_persons)
    {
        $this->max_persons = $max_persons;
    
        return $this;
    }

    /**
     * Get max_persons
     *
     * @return integer 
     */
    public function getMaxPersons()
    {
        return $this->max_persons;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return room
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return room
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set hotel
     *
     * @param \Ben\AssociationBundle\Entity\Hotels $hotel
     * @return posts
     */
    public function setHotel(\Ben\AssociationBundle\Entity\Hotels $hotel)
    {
        $this->hotel = $hotel;
    
        return $this;
    }

    /**
     * Get hotel
     *
     * @return \Ben\AssociationBundle\Entity\Hotels 
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Set floor
     *
     * @param integer $floor
     * @return Rooms
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
    
        return $this;
    }

    /**
     * Get floor
     *
     * @return integer 
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set available
     *
     * @param integer $available
     * @return Rooms
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    
        return $this;
    }

    /**
     * Get available
     *
     * @return integer 
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Add reservation
     *
     * @param Ben\AssociationBundle\Entity\Reservation $reservation
     * @return Rooms
     */
    public function addReservation(\Ben\AssociationBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;
        $reservation->setRoom($this);
    
        return $this;
    }

    /**
     * Remove reservations
     *
     * @param Ben\AssociationBundle\Entity\Reservation $reservations
     */
    public function removeReservation(\Ben\AssociationBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    public function __toString()
    {
        return ''.$this->number;
    }

    /* to array */
    public function toArray()
    {
        return array(
           'id' => $this->getId(),
           'number' => $this->getNumber(),
           'floor' => $this->getFloor(),
           'maxPersons' => $this->getMaxPersons(),
           'available' => $this->getAvailable(),
           'status' => $this->getStatus(),
           'type' => $this->getType(),
           );
    }
}