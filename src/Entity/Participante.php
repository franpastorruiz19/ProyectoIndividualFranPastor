<?php

namespace App\Entity;

use App\Repository\ParticipanteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipanteRepository::class)]
class Participante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idActividad = null;

    #[ORM\Column]
    private ?int $idCliente = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdActividad(): ?int
    {
        return $this->idActividad;
    }

    public function setIdActividad(int $idActividad): self
    {
        $this->idActividad = $idActividad;

        return $this;
    }

    public function getIdCliente(): ?int
    {
        return $this->idCliente;
    }

    public function setIdCliente(int $idCliente): self
    {
        $this->idCliente = $idCliente;

        return $this;
    }
}
