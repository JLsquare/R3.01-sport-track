<?php include __ROOT__."/views/head.html"; ?>

<?php include __ROOT__."/views/header.html"; ?>

<main class="d-flex flex-column justify-content-center align-items-center h-100">
    <section class="my-3 p-4 bg-white rounded-4 shadow w-50 mx-auto overflow-auto">
        <h2>Télécharger un fichier</h2>
        <hr>
        <div class="d-flex w-100 justify-content-center">
            <form action="/upload" method="post" enctype="multipart/form-data" class="w-50">
                <label for="file" class="form-label">Fichier (JSON)</label>
                <input class="form-control w-100" id="file" type="file" name="file" accept=".json" required>
                <button type="submit" class="btn btn-primary w-100 mt-3">Envoyer</button>
                <?php include __ROOT__."/views/error.php"; ?>
            </form>
        </div>
    </section>
    <div class="text-center d-flex justify-content-around w-50">
        <div class="w-100 m-3"></div>
        <a href="/panel" class="btn btn-primary w-100 m-2 shadow">Retour</a>
        <div class="w-100 m-3"></div>
    </div>
</main>

<?php include __ROOT__."/views/footer.html"; ?>