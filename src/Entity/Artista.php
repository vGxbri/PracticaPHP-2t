<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'artistas')]
class Artista
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $nombre;

    #[ORM\OneToOne(targetEntity: Usuario::class, inversedBy: 'artista')]
    #[ORM\JoinColumn(name: 'user', referencedColumnName: 'user', nullable: true)]
    private ?Usuario $user;

    #[ORM\ManyToMany(targetEntity: Cancion::class, mappedBy: 'artistas')]
    private Collection $canciones;

    public function __construct(string $nombre, ?Usuario $user = null)
    {
        $this->nombre = $nombre;
        $this->user = $user;
        $this->canciones = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getUser(): ?Usuario
    {
        return $this->user;
    }

    public function setUser(?Usuario $user): void
    {
        $this->user = $user;
    }

    public function getCanciones(): Collection
    {
        return $this->canciones;
    }
}