<?php include __ROOT__."/views/head.html"; ?>

<?php include __ROOT__."/views/header.html"; ?>

<main class="d-flex flex-column justify-content-center align-items-center h-100">
    <section class="my-3 p-4 bg-white rounded-4 shadow w-50 mx-auto">
        <h2>S'enregistrer</h2>
        <hr>
        <form action="/user_add" method="post" class="row row-cols-2 mt-3">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" id="name" class="form-control" placeholder="Nom" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Prénom</label>
                <input type="text" id="surname" class="form-control" placeholder="Prénom" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">Date de Naissance</label>
                <input type="date" id="birthdate" class="form-control" name="birthdate" required>
            </div>
            <div class="mb-3">
                <label for="sex" class="form-label">Sexe</label>
                <select id="sex" class="form-control form-control-sm" name="gender" required>
                    <option value="" selected="selected">Choisir votre sexe</option>
                    <option value="male">Homme</option>
                    <option value="female">Femme</option>
                    <option value="other">Autre</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="height" class="form-label">Taille (en centimètres)</label>
                <input type="number" id="height" class="form-control" placeholder="0" min="0" name="height" required>
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Poids (en kg)</label>
                <input type="number" id="weight" class="form-control" placeholder="0" min="0" name="weight" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse Email</label>
                <input type="email" id="email" class="form-control" placeholder="nom.e0000000@etud.univ-ubs.fr" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de Passe</label>
                <input type="password" id="password" class="form-control" placeholder="Mot de passe" name="password" required minlength="8">
            </div>
            <div class="text-center d-flex flex-column justify-content-around align-items-center w-100">
                <?php include __ROOT__."/views/error.php"; ?>
                <button type="submit" class="btn btn-primary w-50">S'enregistrer</button>
                <p class="mt-2">Vous avez déjà un compte? <a href="/">Se connecter</a></p>
            </div>
        </form>
    </section>
</main>

<?php include __ROOT__."/views/footer.html"; ?>
