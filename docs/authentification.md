# Authentification

```
USER: email, password, firstname, lastname, status, role
```

- Model User pour enregister les utilisateurs
- l'administrateur enregistre le USER en BDD
- formulaire de connexion
- identifiant / mot de passe
- deconnexion

## Pour connecter un utilisateur

On va lui afficher un formulaire de connexion.

Puis lorsqu'il valider il faudra vérifier s'il existe en BDD avec la logique suivante

```php
// Traitement du formulaire de connexion

// récupérer les données
// id / mdp

// valider les données
// on va rechercher en BDD un utilisateur avec l'identifiant fournit
// on valide que le mot de passe est le meme que celui fournit

// traiter le formulaire
// ici connexion de l'utilisateur

// redirection
// vers la home
```
