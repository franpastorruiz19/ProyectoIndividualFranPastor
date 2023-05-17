<?php

namespace App\Entity;

use App\Repository\ActividadRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActividadRepository::class)]
class Actividad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $tipoActividad = null;

    #[ORM\Column]
    private ?int $idEmpresa = null;

    #[ORM\Column]
    private ?float $precio = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 250, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?int $participantes = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaActividad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoActividad(): ?string
    {
        return $this->tipoActividad;
    }

    public function setTipoActividad(string $tipoActividad): self
    {
        $this->tipoActividad = $tipoActividad;

        return $this;
    }

    public function getIdEmpresa(): ?int
    {
        return $this->idEmpresa;
    }

    public function setIdEmpresa(int $idEmpresa): self
    {
        $this->idEmpresa = $idEmpresa;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getParticipantes(): ?int
    {
        return $this->participantes;
    }

    public function setParticipantes(int $participantes): self
    {
        $this->participantes = $participantes;

        return $this;
    }

    public function getFechaActividad(): ?\DateTimeInterface
    {
        return $this->fechaActividad;
    }

    public function setFechaActividad(\DateTimeInterface $fechaActividad): self
    {
        $this->fechaActividad = $fechaActividad;

        return $this;
    }
}
