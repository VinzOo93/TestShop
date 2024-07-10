
## Retour de Test

J’ai volontairement choisi de ne pas migrer entièrement la classe User pour ne pas casser l’authentification des utilisateurs existants. Actuellement, dans le projet, vous utilisez un encodage en MD5 pour chiffrer les mots de passe. Symfony utilise nativement un password hasher dans PasswordAuthenticatedUserInterface, qui utilise un algorithme de chiffrement plus sécurisé.

La fonction getSalt avec la clé ‘unPetitGrainDeSel’ permet de trouver facilement comment rendre visibles les mots de passe.

Je propose comme solution d’évolution de migrer les données existantes avec une commande Symfony qui reprendra une à une chaque donnée des utilisateurs dans le but de migrer le mot de passe vers la nouvelle norme. La commande se chargera de reprendre l’ancien mot de passe, de le déchiffrer avec MD5/getSalt, puis de le rechiffrer avec le nouveau passwordHasher et de l’enregistrer en BDD.

Ainsi, nous serons certains que tous les mots de passe seront migrés et nous éviterons les potentielles failles de sécurité.

## Setup

Prérequis
PHP 8.0 minimum

npm i
./node_modules/.bin/encore dev
php -S 127.0.0.1:8000 -t public
```

La base de données est en SQLite, donc il n'est pas nécessaire de créer et configurer un SQL local.

Le site est accessible sur http://127.0.0.1:8000

## Modifications

Pour plus de lisibilité et de compréhension de vos modifications, vous devez les ajouter au controle de code source via **dans des commits séparés**.

Eventuellement, vous pouvez préciser le temps passé sur chaque correction/amélioration.

Si vous voyez des modifications qui demanderaient trop de temps pour être réalisées dans le cadre de ce test, n'hésitez pas à les expliquer dans ce fichier README, cela nous permet de mieux comprendre votre façon d'organiser le code.

Bon refactoring !
