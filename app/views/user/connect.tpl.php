<div class="container my-4">
        <a href="<?= $router->generate('main-home') ?>" class="btn btn-success float-end">Retour</a>
        <h2>Connexion</h2>

        <form action="" method="POST" class="mt-5">
            <?php if (!empty($errorList)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errorList as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre Email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary mt-5">Valider</button>
            </div>
        </form>
    </div>