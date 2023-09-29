<?php
if(isset($data['error'])) {
    echo '<div class="alert alert-danger py-2 px-3 my-4" role="alert">';
    echo '<span>' . $data['error'] . '</span>'; // Espace à droite pour séparer du bouton
    if(isset($data['errorlog'])) {
        echo '<button type="button" class="btn btn-sm ms-2" data-bs-toggle="collapse" data-bs-target="#errorLog">';
        echo '&#x25BC;'; // Flèche vers le bas
        echo '</button>';
        echo '<div id="errorLog" class="collapse mt-2">' . htmlspecialchars($data['errorlog']) . '</div>'; // Espace au-dessus pour séparer du message d'erreur
    }
    echo '</div>';
}
?>
