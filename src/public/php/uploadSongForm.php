<?php
require ('agregarCancion.php');
require_once '../../Entity/Usuario.php';
require_once '../../Entity/Artista.php';
require_once '../../Entity/Cancion.php';

use Entity\Artista;

if (isset($_SESSION['error_uploadsong'])) {
    echo "<div class='formulario-cancion-div' id='uploadSongForm' style='display: flex'>";
} else {
    echo "<div class='formulario-cancion-div' id='uploadSongForm' style='display: none'>";
}
?>
    <form class="formulario-cancion" method="POST" enctype="multipart/form-data">
        <a id="exitFormUploadSong">
            <svg id="exitFormIcon" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 15 15">
                <path fill="#23cf5f" d="M3.64 2.27L7.5 6.13l3.84-3.84A.92.92 0 0 1 12 2a1 1 0 0 1 1 1a.9.9 0 0 1-.27.66L8.84 7.5l3.89 3.89A.9.9 0 0 1 13 12a1 1 0 0 1-1 1a.92.92 0 0 1-.69-.27L7.5 8.87l-3.85 3.85A.92.92 0 0 1 3 13a1 1 0 0 1-1-1a.9.9 0 0 1 .27-.66L6.16 7.5L2.27 3.61A.9.9 0 0 1 2 3a1 1 0 0 1 1-1c.24.003.47.1.64.27"/></svg>
        </a>
        <h2 class="formulario-cancion-tit">Subir Canción</h2>
        <div>
            <label for="nombreCancion">Nombre de la canción:</label>
            <input type="text" id="nombreCancion" name="nombreCancion" required>
        </div>

        <div>
            <label for="duracion">Duración de la canción (en segundos):</label>
            <input type="number" id="duracion" name="duracion" min="1" required>
        </div>

        <div>
            <label for="artistas">Artistas:</label>
            <select id="artistas" name="artistas[]" multiple required>
                <?php
                try {
                    // Usar el EntityManager que ya existe en el scope padre
                    if (isset($entityManager)) {
                        $artistaRepository = $entityManager->getRepository(Artista::class);
                        $artistas = $artistaRepository->findAll();

                        foreach ($artistas as $artista) {
                            $nombreArtista = htmlspecialchars($artista->getNombre());
                            echo "<option value='".$nombreArtista."'>".$nombreArtista."</option>";
                        }
                    } else {
                        throw new \Exception("EntityManager no disponible");
                    }
                } catch(\Exception $e) {
                    echo "<option value=''>Error al cargar artistas: " . $e->getMessage() . "</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="fechaEstreno">Fecha de estreno (DD/MM/YYYY):</label>
            <input type="text" id="fechaEstreno" name="fechaEstreno" required>
        </div>

        <div>
            <label for="cover">Cover de la canción:</label>
            <input type="file" id="cover" name="cover" accept="image/*" required>
        </div>
        <?php
        if (isset($_SESSION['error_uploadsong'])) {
            echo "<p style='color: #cc0000; display: flex; justify-content: center; margin-top: 0;'>".$_SESSION['error_uploadsong']."</p>";
        }
        ?>
        <button type="submit" name="subir_cancion">Subir Canción</button>
    </form>
</div>

<?php
    unset($_SESSION['error_uploadsong']);
?>