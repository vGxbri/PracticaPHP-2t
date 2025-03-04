<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Entidad que representa un usuario en la plataforma
 * Contiene información sobre el usuario y sus relaciones con canciones y artistas
 */
#[ORM\Entity]
#[ORM\Table(name: 'usuarios')]
class Usuario
{
    /**
     * Nombre de usuario, utilizado como identificador único
     * Clave primaria con longitud máxima de 50 caracteres
     */
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    private string $user;

    /**
     * Hash de la contraseña del usuario
     * Almacena la contraseña encriptada para mayor seguridad
     */
    #[ORM\Column(type: 'string', length: 255)]
    private string $password_hash;

    /**
     * Indica si el usuario es un artista
     * Por defecto es falso hasta que se asocie con un perfil de artista
     */
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $es_artista = false;

    /**
     * Canciones subidas por el usuario
     * Relación uno a muchos con la entidad Cancion
     */
    #[ORM\OneToMany(targetEntity: Cancion::class, mappedBy: 'usuario')]
    private Collection $canciones;

    /**
     * Perfil de artista asociado al usuario
     * Relación uno a uno con la entidad Artista
     */
    #[ORM\OneToOne(targetEntity: Artista::class, mappedBy: 'user')]
    private ?Artista $artista = null;

    /**
     * Canciones marcadas como favoritas por el usuario
     * Relación muchos a muchos con la entidad Cancion
     */
    #[ORM\ManyToMany(targetEntity: Cancion::class, inversedBy: 'usuariosFavoritos')]
    #[ORM\JoinTable(name: 'canciones_favoritas',
        joinColumns: [new ORM\JoinColumn(name: 'user', referencedColumnName: 'user')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'cancion_id', referencedColumnName: 'id')]
    )]
    private Collection $cancionesFavoritas;

    /**
     * Constructor de la clase
     * @param string $user Nombre de usuario
     * @param string $password Contraseña en texto plano
     * @param string|null $existingHash Hash existente (opcional, para migraciones)
     */
    public function __construct(string $user, string $password, ?string $existingHash = null)
    {
        $this->user = $user;
        $this->password_hash = $existingHash ?? password_hash($password, PASSWORD_DEFAULT);
        $this->canciones = new ArrayCollection();
        $this->cancionesFavoritas = new ArrayCollection();
    }

    /**
     * Obtiene el nombre de usuario
     * @return string Nombre de usuario
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * Obtiene el hash de la contraseña
     * @return string Hash de la contraseña
     */
    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    /**
     * Establece un nuevo hash de contraseña
     * @param string $password_hash Nuevo hash de contraseña
     */
    public function setPasswordHash(string $password_hash): void
    {
        $this->password_hash = $password_hash;
    }

    /**
     * Verifica si el usuario es un artista
     * @return bool Verdadero si es artista, falso en caso contrario
     */
    public function isArtista(): bool
    {
        return $this->es_artista;
    }

    /**
     * Establece el estado de artista del usuario
     * @param bool $es_artista Nuevo estado de artista
     */
    public function setEsArtista(bool $es_artista): void
    {
        $this->es_artista = $es_artista;
    }

    /**
     * Obtiene las canciones subidas por el usuario
     * @return Collection Colección de canciones
     */
    public function getCanciones(): Collection
    {
        return $this->canciones;
    }

    /**
     * Obtiene las canciones favoritas del usuario
     * @return Collection Colección de canciones favoritas
     */
    public function getCancionesFavoritas(): Collection
    {
        return $this->cancionesFavoritas;
    }

    /**
     * Obtiene el perfil de artista asociado al usuario
     * @return Artista|null Perfil de artista o null si no es artista
     */
    public function getArtista(): ?Artista
    {
        return $this->artista;
    }

    /**
     * Añade una canción a las favoritas del usuario
     * @param Cancion $cancion Canción a añadir a favoritos
     */
    public function addCancionFavorita(Cancion $cancion): void
    {
        if (!$this->cancionesFavoritas->contains($cancion)) {
            $this->cancionesFavoritas->add($cancion);
        }
    }

    /**
     * Elimina una canción de las favoritas del usuario
     * @param Cancion $cancion Canción a eliminar de favoritos
     */
    public function removeCancionFavorita(Cancion $cancion): void
    {
        $this->cancionesFavoritas->removeElement($cancion);
    }

    /**
     * Establece el perfil de artista asociado al usuario
     * También actualiza el estado de artista automáticamente
     * @param Artista|null $artista Perfil de artista a asociar
     */
    public function setArtista(?Artista $artista): void
    {
        $this->artista = $artista;
        $this->es_artista = ($artista !== null);
    }

    /**
     * Establece un nuevo nombre de usuario
     * @param string $user Nuevo nombre de usuario
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }
}