# liligiroud1980

- Pour cloner le projet: 
```console
git clone git@github.com:lamdakara/liligiroud1980.git
```

- Ensuite executer la commande suivante pour générer votre propre `.env.local.php` :
```console
composer dump-env dev
```
Remplir vos identifiants de connexion à la base de donnée ainsi les identifiants de tocken pour Stripe

- Ensuite executer la commande suivante pour installer les dépendances du projet ainsi sur que la mise à jour de DB : 
```console
composer install
php bin/console d:d:c # pour créer la base de donnée
php bin/console do:mi:migrate # pour lancer les migrations 
symfony server:start -d # pour demarrer le server 
```
Et enfin rdv sur la page https://127.0.0.1:8000/
