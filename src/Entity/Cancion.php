<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Entidad que representa una canción en la plataforma
 * Contiene información sobre la canción y sus relaciones con artistas y usuarios
 */
#[ORM\Entity]
#[ORM\Table(name: 'canciones')]
class Cancion
{
    /**
     * Identificador único de la canción
     * Clave primaria autoincrementable
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    /**
     * Nombre de la canción
     * Longitud máxima de 50 caracteres
     */
    #[ORM\Column(type: 'string', length: 50)]
    private string $nombre;

    /**
     * Duración de la canción en segundos
     */
    #[ORM\Column(type: 'integer')]
    private int $duracion;

    /**
     * Fecha de estreno de la canción
     */
    #[ORM\Column(type: 'date')]
    private \DateTime $fecha_estreno;

    /**
     * Ruta a la imagen de portada de la canción
     * Longitud máxima de 255 caracteres
     */
    #[ORM\Column(type: 'string', length: 255)]
    private string $cover;

    /**
     * Usuario que subió la canción
     * Relación muchos a uno con la entidad Usuario
     */
    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'canciones')]
    #[ORM\JoinColumn(name: 'user', referencedColumnName: 'user', nullable: true)]
    private ?Usuario $usuario;

    /**
     * Artistas asociados a la canción
     * Relación muchos a muchos con la entidad Artista
     */
    #[ORM\ManyToMany(targetEntity: Artista::class, inversedBy: 'canciones')]
    #[ORM\JoinTable(name: 'artistas_canciones')]
    private Collection $artistas;

    /**
     * Usuarios que han marcado esta canción como favorita
     * Relación muchos a muchos con la entidad Usuario
     */
    #[ORM\ManyToMany(targetEntity: Usuario::class, mappedBy: 'cancionesFavoritas')]
    private Collection $usuariosFavoritos;

    /**
     * Constructor de la clase
     * @param string $nombre Nombre de la canción
     * @param int $duracion Duración en segundos
     * @param \DateTime $fecha_estreno Fecha de estreno
     * @param string $cover Ruta a la imagen de portada
     * @param Usuario|null $usuario Usuario que sube la canción (opcional)
     */
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

    /**
     * Obtiene el ID de la canción
     * @return int ID de la canción
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre de la canción
     * @return string Nombre de la canción
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Obtiene la duración de la canción en segundos
     * @return int Duración en segundos
     */
    public function getDuracion(): int
    {
        return $this->duracion;
    }

    /**
     * Obtiene la fecha de estreno de la canción
     * @return \DateTime Fecha de estreno
     */
    public function getFechaEstreno(): \DateTime
    {
        return $this->fecha_estreno;
    }

    /**
     * Obtiene la ruta a la imagen de portada
     * @return string Ruta a la imagen
     */
    public function getCover(): string
    {
        return $this->cover;
    }

    /**
     * Obtiene el usuario que subió la canción
     * @return Usuario|null Usuario o null si no hay usuario asociado
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * Obtiene la colección de artistas asociados a la canción
     * @return Collection Colección de artistas
     */
    public function getArtistas(): Collection
    {
        return $this->artistas;
    }

    /**
     * Obtiene la colección de usuarios que han marcado esta canción como favorita
     * @return Collection Colección de usuarios
     */
    public function getUsuariosFavoritos(): Collection
    {
        return $this->usuariosFavoritos;
    }

    /**
     * Establece el usuario que subió la canción
     * @param Usuario|null $usuario El usuario que subió la canción
     * @return self
     */
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
    }
}