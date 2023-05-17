<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 60)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $contrasena = null;

    #[ORM\Column(length: 40)]
    private ?string $tipo = null;

    #[ORM\OneToMany(mappedBy: 'idUsuario', targetEntity: Cliente::class)]
    private Collection $clientes;

    #[ORM\OneToMany(mappedBy: 'idUsuario', targetEntity: Empresa::class)]
    private Collection $empresas;



    public function __construct()
    {
        $this->clientes = new ArrayCollection();
        $this->empresas= new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getContrasena(): ?string
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena): self
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection<int, Cliente>
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes->add($cliente);
            $cliente->setIdUser($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getIdUser() === $this) {
                $cliente->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Empresa>
     */
    public function getEmpresas(): Collection
    {
        return $this->empresas;
    }

    public function addEmpresa(Empresa $empresa): self
    {
        if (!$this->empresas->contains($empresa)) {
            $this->empresas->add($empresa);
            $empresa->setIdUser($this);
        }

        return $this;
    }

    public function removeEmpresa(Empresa $empresa): self
    {
        if ($this->empresas->removeElement($empresa)) {
            // set the owning side to null (unless already changed)
            if ($empresa->getIdUser() === $this) {
                $empresa->setIdUser(null);
            }
        }

        return $this;
    }
}
