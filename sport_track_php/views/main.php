<?php include __ROOT__."/views/head.html"; ?>

<header class="d-flex justify-content-center px-5">
    <img src="../static/img/logo.png" class="img-fluid w-50 p-5" alt="Sport Track Logo">
</header>
<main class="mb-5 h-50">
    <div class="d-flex h-100">
        <article class="p-4 bg-white rounded-4 shadow w-50 mx-auto mb-5 overflow-auto">
            <h2>SportTrack : Votre Assistant de Suivi Sportif</h2>
            <hr>
            <h4>En Bref</h4>
            <p>SportTrack est une application Web conçue pour les sportifs équipés d'une montre "cardio/gps". L'application vous permet de gérer vos activités physiques en toute simplicité.</p>
            <h4>Fonctionnalités Clés</h4>
            <ul>
                <li><strong>Gestion de Compte</strong>: Créez et personnalisez votre profil avec des informations telles que votre nom, âge, taille et poids.</li>
                <li><strong>Connexion Sécurisée</strong>: Utilisez votre adresse électronique et votre mot de passe pour accéder à vos données.</li>
                <li><strong>Suivi d'Activités</strong>: Importez, visualisez et gérez vos fichiers d'activités sportives au format JSON. Obtenez des statistiques détaillées comme la distance parcourue et les fréquences cardiaques.</li>
            </ul>
            <p>L'application est développée en PHP et Javascript, avec une base de données SQLite3 pour le stockage des informations.</p>
        </article>
        <article class="p-4 bg-white rounded-4 shadow w-25 mx-auto mb-5 overflow-auto">
            <?php include __ROOT__."/views/user_connect_form.php"; ?>
        </article>
    </div>
</main>

<?php include __ROOT__."/views/footer.html"; ?>

