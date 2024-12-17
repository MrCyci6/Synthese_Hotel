Configurer github version CMD:

Première connexion
```sh
git init
git add "les fichiers à ajouter, mettre un point (.) pour mettre tout le projet"
git commit -m "Description de votre commit. 'J'ai ajouté une navbar'"
git branch -m "votre prénom, exemple: cyriac"
git remote add origin https://github.com/MrCyci6/Synthese_Hotel.git
git push -u origin "votre prénom, exemplre: cyriac"
```

pour la suite
```sh
git add "fichiers"
git commit -m "message du commit"
```
Avant de push, vérifier vous êtes bien sur la bonne branche (pas sur le main) avec `git branch`
```
git push
```

**Pas oublier de créer un .gitignore à la racine de votre projet, ce fichier sert à ignorer des fichiers sensibles sur votre commit**
exemple de .gitignore:
```txt
motdepasse.txt
dossier_secret/
dossier1/motdepasse.txt
```
