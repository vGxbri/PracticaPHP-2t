<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'canciones')]
class Cancion
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', length: 50)]
    private string $nombre;

    #[ORM\Column(type: 'integer')]
    private int $duracion;

    #[ORM\Column(type: 'date')]
    private \DateTime $fecha_estreno;

    #[ORM\Column(type: 'string', length: 255)]
    private string $cover;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'canciones')]
    #[ORM\JoinColumn(name: 'user', referencedColumnName: 'user', nullable: true)]
    private ?Usuario $usuario;

    #[ORM\ManyToMany(targetEntity: Artista::class, inversedBy: 'canciones')]
    #[ORM\JoinTable(name: 'artistas_canciones')]
    private Collection $artistas;

    #[ORM\ManyToMany(targetEntity: Usuario::class, mappedBy: 'cancionesFavoritas')]
    private Collection $usuariosFavoritos;

    public function __construct(string $nombre, int $duracion, \DateTime $fecha_estreno, string $cover, ?Usuario $usuario = null)
    {
        $this->nombre = $nombre;
        $this->duracion = $duracion;
        $this->fecha_estreno = $fecha_estreno;
        $this->cover = $cover;
        $this->usuario = $usuario;
        $this->artistas = new ArrayCollection();
        $this->usuariosFavoritos = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDuracion(): int
    {
        return $this->duracion;
    }

    public function getFechaEstreno(): \DateTime
    {
        return $this->fecha_estreno;
    }

    public function getCover(): string
    {
        return $this->cover;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function getArtistas(): Collection
    {
        return $this->artistas;
    }

    // Remove this method as it's no longer needed
    // public function getFavoritos(): Collection
    // {
    //     return $this->favoritos;
    // }

    public function getUsuariosFavoritos(): Collection
    {
        return $this->usuariosFavoritos;
    }
}