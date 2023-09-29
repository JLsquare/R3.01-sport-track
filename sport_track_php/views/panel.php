<?php include __ROOT__."/views/head.html"; ?>

<?php include __ROOT__."/views/header.html"; ?>

<main class="d-flex flex-column justify-content-center align-items-center h-100">
    <div class="d-flex w-100 justify-content-center align-items-center my-3">
        <?php include __ROOT__."/views/user_connect_valid.php"; ?>
    </div>
    <div class="text-center d-flex justify-content-around w-50">
        <a href="/user_edit" class="btn btn-primary w-100 m-2 shadow">Modifier son profile</a>
        <a href="/activities" class="btn btn-primary w-100 m-2 shadow">Liste des activités</a>
        <a href="/upload" class="btn btn-primary w-100 m-2 shadow">Télécharger un fichier</a>
    </div>
</main>

<?php include __ROOT__."/views/footer.html"; ?>
