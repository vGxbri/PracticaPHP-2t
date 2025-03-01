<?php
use Entity\Cancion;

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Get EntityManager
$entityManager = require_once __DIR__ . "/../../../doctrine-config.php";
?>

<div class="titCanciones">
    <h1 class="titCanciones-inside">Canciones</h1>
    <form method="GET" action="index.php" class="search-form">
        <input type="text" name="query" placeholder="Buscar canción..." class="search-input" value="<?php echo htmlspecialchars($query); ?>">
        <button type="submit" class="search-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48"><g fill="none" stroke="#23cf5f" stroke-linecap="round" stroke-width="4"><path d="m31 31l10 10"/><circle cx="20" cy="20" r="14"/></g></svg>
        </button>
    </form>
</div>

<?php
if (isset($_SESSION['error_addsong'])) {
    echo "<p style='color: #cc0000; margin: 0 0 0 12px;'>".$_SESSION['error_addsong']."</p>";
    unset($_SESSION['error_addsong']);
}
?>

<div class="songs">
    <?php
    try {
        // Get repository and find all songs
        $cancionRepository = $entityManager->getRepository(Cancion::class);
        
        if (!empty($query)) {
            // If there's a search query, use DQL to search with JOIN
            $qb = $entityManager->createQueryBuilder();
            $qb->select('c', 'a')
               ->from(Cancion::class, 'c')
               ->leftJoin('c.artistas', 'a')
               ->where('c.nombre LIKE :query')
               ->setParameter('query', '%' . $query . '%');
            
            $canciones = $qb->getQuery()->getResult();
        } else {
            // If no search query, get all songs with artists
            $qb = $entityManager->createQueryBuilder();
            $qb->select('c', 'a')
               ->from(Cancion::class, 'c')
               ->leftJoin('c.artistas', 'a');
            
            $canciones = $qb->getQuery()->getResult();
        }

        foreach ($canciones as $cancion) {
            $artistasNombres = [];
            foreach ($cancion->getArtistas() as $artista) {
                $artistasNombres[] = $artista->getNombre();
            }
            $artistasString = !empty($artistasNombres) ? implode(', ', $artistasNombres) : 'Sin artistas';

            echo "<div class='songs-inside'>";
            echo     "<img src='" . htmlspecialchars($cancion->getCover()) . "' class='cover'>";
            echo     "<div class='bottomCover'>";
            echo         "<div class='columnLeft'>";
            echo             "<h2 class='titSong'>" . htmlspecialchars($cancion->getNombre()) . "</h2>";
            echo             "<p class='artist'>" . htmlspecialchars($artistasString) . "</p>";
            echo         "</div>";
            echo         "<div class='columnRight'>";
            echo             "<label class='addTo'>";
            echo                 "<button class='buttonAddTo' onclick=\"guardarCancion('" . $cancion->getId() . "')\">";
            echo                 "<svg xmlns='http://www.w3.org/2000/svg' width='30px' height='30px' viewBox='0 0 48 48'><g fill='none' stroke='#23cf5f' stroke-linejoin='round' stroke-width='4'><path d='M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20Z'/><path stroke-linecap='round' d='M24 16v16m-8-8h16'/></g></svg>";
            echo                 "</button>";
            echo             "</label>";
            echo         "</div>";
            echo     "</div>";
            echo "</div>";
        }
    } catch(Exception $e) {
        echo "<p style='color: #cc0000; margin-left: 12px'>Error: " . $e->getMessage() . "</p>";
    }
    ?>
</div>
