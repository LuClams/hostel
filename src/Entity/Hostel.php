<?php

namespace App\Entity;

use App\Repository\HostelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HostelRepository::class)]
class Hostel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\OneToOne(mappedBy: 'hostel', targetEntity: Room::class, cascade: ['persist', 'remove'])]
    private $room;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        // unset the owning side of the relation if necessary
        if ($room === null && $this->room !== null) {
            $this->room->setHostel(null);
        }

        // set the owning side of the relation if necessary
        if ($room !== null && $room->getHostel() !== $this) {
            $room->setHostel($this);
        }

        $this->room = $room;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
