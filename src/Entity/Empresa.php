<?php

namespace App\Entity;

use App\Repository\EmpresaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpresaRepository::class)]
class Empresa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $tipoEmpresa = null;

    #[ORM\Column]
    private ?float $dinero = null;

    #[ORM\ManyToOne(inversedBy: 'empresas')]
    #[ORM\JoinColumn(nullable: false, name: "id_usuario", referencedColumnName: "id")]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoEmpresa(): ?string
    {
        return $this->tipoEmpresa;
    }

    public function setTipoEmpresa(string $tipoEmpresa): self
    {
        $this->tipoEmpresa = $tipoEmpresa;

        return $this;
    }

    public function getDinero(): ?float
    {
        return $this->dinero;
    }

    public function setDinero(float $dinero): self
    {
        $this->dinero = $dinero;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->user;
    }

    public function setIdUser(?User $userId): self
    {
        $this->user = $userId;

        return $this;
    }
}
