
<div class="container my-4">
    <a href="<?= $router->generate('product-browse'); ?>" class="btn btn-success float-end">Retour</a>
    <h2>Ajouter un produit</h2>

    <form action="" method="POST" class="mt-5">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" placeholder="Nom du produit">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" placeholder="Description"></textarea>
        </div>
        <div class="mb-3">
            <label for="subtitle" class="form-label">Sous-titre</label>
            <input type="text" class="form-control" id="subtitle" placeholder="Sous-titre" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Sera affiché sur la page d'accueil comme bouton devant l'image
            </small>
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Image</label>
            <input type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="number" step=".1" min="0" class="form-control" id="price" placeholder="Prix du produit">
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Note</label>
            <input type="number" max="5" min="0" class="form-control" id="rate" placeholder="Note du produit">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <label><input type="radio" value="0" name="status" id="status-inactive"> Inactif</label>
            <label><input type="radio" value="1" name="status" id="status-inactive"> Actif</label>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select id="category_id" class="form-control">
                <option value="1">Catégorie 1</option>
                <option value="2">Catégorie 2</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Marque</label>
            <select id="brand_id" class="form-control">
                <option value="1">Marque 1</option>
                <option value="1">Marque 2</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="type_id" class="form-label">Type</label>
            <select id="type_id" class="form-control">
                <option value="1">Type 1</option>
                <option value="1">Type 2</option>
            </select>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-5">Valider</button>
        </div>
    </form>
</div>
