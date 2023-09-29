<?php include __ROOT__."/views/head.html"; ?>

<?php include __ROOT__."/views/header.html"; ?>

<main class="d-flex flex-column justify-content-center align-items-center h-100">
    <section class="my-3 p-4 bg-white rounded-4 shadow w-50">
        <h2>Utilisateur créer</h2>
        <hr>
        <p>Felicitation <?php echo $data['lastname']; ?>. Votre compte utilisateur a été créer.</p>
        <p>Vous pouvez maintenant vous connecter <a href="/">ici</a>.</p>
    </section>
</main>

<?php include __ROOT__."/views/footer.html"; ?>
