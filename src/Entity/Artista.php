<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Entidad que representa a un artista en la plataforma
 * Contiene información sobre el artista y sus relaciones con usuarios y canciones
 */
#[ORM\Entity]
#[ORM\Table(name: 'artistas')]
class Artista
{
    /**
     * Identificador único del artista
     * Clave primaria autoincrementable
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    /**
     * Nombre del artista
     * Longitud máxima de 100 caracteres
     */
    #[ORM\Column(type: 'string', length: 100)]
    private string $nombre;

    /**
     * Relación con el usuario asociado al artista
     * Relación uno a uno con la entidad Usuario
     * El campo puede ser nulo si el artista no tiene usuario asociado
     */
    #[ORM\OneToOne(targetEntity: Usuario::class, inversedBy: 'artista')]
    #[ORM\JoinColumn(name: 'user', referencedColumnName: 'user', nullable: true)]
    private ?Usuario $user;

    /**
     * Colección de canciones del artista
     * Relación muchos a muchos con la entidad Cancion
     */
    #[ORM\ManyToMany(targetEntity: Cancion::class, mappedBy: 'artistas')]
    private Collection $canciones;

    /**
     * Constructor de la clase
     * @param string $nombre Nombre del artista
     * @param Usuario|null $user Usuario asociado (opcional)
     */
    public function __construct(string $nombre, ?Usuario $user = null)
    {
        $this->nombre = $nombre;
        $this->user = $user;
        $this->canciones = new ArrayCollection();
    }

    /**
     * Obtiene el ID del artista
     * @return int ID del artista
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre del artista
     * @return string Nombre del artista
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Establece el nombre del artista
     * @param string $nombre Nuevo nombre del artista
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * Obtiene el usuario asociado al artista
     * @return Usuario|null Usuario asociado o null si no tiene
     */
    public function getUser(): ?Usuario
    {
        return $this->user;
    }

    /**
     * Establece el usuario asociado al artista
     * @param Usuario|null $user Usuario a asociar o null para eliminar la asociación
     */
    public function setUser(?Usuario $user): void
    {
        $this->user = $user;
    }

    /**
     * Obtiene la colección de canciones del artista
     * @return Collection Colección de canciones
     */
    public function getCanciones(): Collection
    {
        return $this->canciones;
    }
}