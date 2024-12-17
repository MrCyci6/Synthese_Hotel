Configurer github version CMD:

```sh
git init
git add "les fichiers à ajouter, mettre un point (.) pour mettre tout le projet"
git commit -m "Description de votre commit. 'J'ai ajouté une navbar'"
git branch -m "votre prénom, exemple: cyriac"
git remote add origin https://github.com/MrCyci6/Synthese_Hotel.git
git push -u origin "votre prénom, exemplre: cyriac"
```

**Pas oublier de créer un .gitignore à la racine de votre projet, ce fichier sert à ignorer des fichiers sensibles sur votre commit**
exemple de .gitignore:
```txt
motdepasse.txt
dossier_secret/
dossier1/motdepasse.txt
```
