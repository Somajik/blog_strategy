 :: class Une « classe » est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. Plus concrètement, nous pouvons percevoir une classe comme un moule grâce auquel nous allons créer autant d'objets de même type et de même structure qu'on le désire.

Par exemple, pour modéliser n'importe quelle personne, nous pourrions écrire une classe Personne dans laquelle nous définissons les attributs (couleurs des yeux, couleurs des cheveux, taille, sexe...) et méthodes (marcher, courir, manger, boire...) communs à tout être humain.

 
 
 erreur : When using date/time fields in EasyAdmin backends, you must install and enable the PHP Intl extension, which is used to format date/time values.
 
 l'activation de l'extension PHP intl pour l'installation de en :

Ouvrez le volet de configuration XAMPP.
Arrêtez le serveur Apache s'il a été démarré.
Ensuite, à partir du bouton Config , cliquez sur l'élément PHP (php.ini) .
entrez la description de l'image ici

Php.ini s'ouvrira dans le Bloc-notes (ou un éditeur de texte par défaut), cliquez sur Ctrl + F et recherchez ;extension=intl et supprimez le point-virgule.
entrez la description de l'image ici

Ensuite, enregistrez et fermez le Bloc-notes et redémarrez le serveur Apache.
Ces étapes pour moi ont résolu le problème.


c'est dans les controlleur qu'on declare les variables 