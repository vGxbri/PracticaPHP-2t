<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'usuarios')]
class Usuario
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    private string $user;

    #[ORM\Column(type: 'string', length: 255)]
    private string $password_hash;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $es_artista = false;

    #[ORM\OneToMany(targetEntity: Cancion::class, mappedBy: 'usuario')]
    private Collection $canciones;

    #[ORM\OneToOne(targetEntity: Artista::class, mappedBy: 'user')]
    private ?Artista $artista = null;

    #[ORM\ManyToMany(targetEntity: Cancion::class, inversedBy: 'usuariosFavoritos')]
    #[ORM\JoinTable(name: 'canciones_favoritas',
        joinColumns: [new ORM\JoinColumn(name: 'user', referencedColumnName: 'user')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'cancion_id', referencedColumnName: 'id')]
    )]
    private Collection $cancionesFavoritas;

    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
        $this->canciones = new ArrayCollection();
        $this->cancionesFavoritas = new ArrayCollection();
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    public function setPasswordHash(string $password): void
    {
        $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
    }

    public function isArtista(): bool
    {
        return $this->es_artista;
    }

    public function setEsArtista(bool $es_artista): void
    {
        $this->es_artista = $es_artista;
    }

    public function getCanciones(): Collection
    {
        return $this->canciones;
    }

    public function getCancionesFavoritas(): Collection
    {
        return $this->cancionesFavoritas;
    }

    public function getArtista(): ?Artista
    {
        return $this->artista;
    }
    public function addCancionFavorita(Cancion $cancion): void
    {
        if (!$this->cancionesFavoritas->contains($cancion)) {
            $this->cancionesFavoritas->add($cancion);
        }
    }

    public function removeCancionFavorita(Cancion $cancion): void
    {
        $this->cancionesFavoritas->removeElement($cancion);
    }

    public function setArtista(?Artista $artista): void
    {
        $this->artista = $artista;
        $this->es_artista = ($artista !== null);
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }
}