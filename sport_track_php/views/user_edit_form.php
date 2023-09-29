<?php include __ROOT__."/views/head.html"; ?>

<?php include __ROOT__."/views/header.html"; ?>

<main class="d-flex flex-column justify-content-center align-items-center h-100">
    <section class="my-3 p-4 bg-white rounded-4 shadow w-50 mx-auto overflow-auto">
        <h2>Modifier son profile</h2>
        <hr>
        <form action="/user_edit" method="post" class="row vh-50 row-cols-2 mt-3">
            <div class="mb-2">
                <label for="name" class="form-label">Nom *</label>
                <input type="text" id="name" class="form-control" value="<?php echo $data['user']->getLastName()?>" name="lastname" required>
            </div>
            <div class="mb-2">
                <label for="surname" class="form-label">Prénom *</label>
                <input type="text" id="surname" class="form-control" value="<?php echo $data['user']->getFirstName()?>" name="firstname" required>
            </div>
            <div class="mb-2">
                <label for="birthdate" class="form-label">Date de Naissance *</label>
                <input type="date" id="birthdate" class="form-control" value="<?php echo $data['user']->getBirthdate()?>" name="birthdate" required>
            </div>
            <div class="mb-2">
                <label for="sex" class="form-label">Sexe *</label>
                <select id="sex" class="form-control form-control-sm" name="gender" required>
                    <option value="male" <?php echo ($data['user']->getGender() == 'male') ? 'selected="selected"' : ''; ?>>Homme</option>
                    <option value="female" <?php echo ($data['user']->getGender() == 'female') ? 'selected="selected"' : ''; ?>>Femme</option>
                    <option value="other" <?php echo ($data['user']->getGender() == 'other') ? 'selected="selected"' : ''; ?>>Autre</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="height" class="form-label">Taille (en centimètres) *</label>
                <input type="number" id="height" class="form-control" value="<?php echo $data['user']->getHeight()?>" min="0" name="height" required>
            </div>
            <div class="mb-2">
                <label for="weight" class="form-label">Poids (en kg) *</label>
                <input type="number" id="weight" class="form-control" value="<?php echo $data['user']->getWeight()?>" min="0" name="weight" required>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Adresse Email *</label>
                <input type="email" id="email" disabled class="form-control" value="<?php echo $data['user']->getEmail()?>" name="email" required>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Mot de Passe</label>
                <input type="password" id="password" class="form-control" placeholder="Mot de passe" name="password" minlength="8">
            </div>
            <div class="mt-3 d-flex text-center justify-content-center w-100">
                <?php include __ROOT__."/views/error.php"; ?>
            </div>
            <div class="text-center mt-3 d-flex w-100">
                <button type="submit" name="action" value="delete" class="btn btn-danger w-50 mx-3 shadow">Supprimer le compte</button>
                <button type="submit" name="action" value="save" class="btn btn-primary w-50 mx-3 shadow">Enregistrer</button>
            </div>
        </form>
    </section>
    <div class="text-center d-flex justify-content-around w-50">
        <div class="w-100 m-3"></div>
        <a href="/panel" class="btn btn-primary w-100 m-2 shadow">Retour</a>
        <div class="w-100 m-3"></div>
    </div>
</main>

<?php include __ROOT__."/views/footer.html"; ?>