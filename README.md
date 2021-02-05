Market-Gardening est un si web qui met en avant la consommation locale et bio de légumes. Elle donne la possibilité à un marraicher de proposer des articles en rapport avec son activité, ainsi qu'un nombre de panier par semaine que les utilisateurs connectés peuvent réserver et aller récupérer directement chez lui.

User Stories : 
    - Possibilité de lire les articles
    - Se connecter
    - Consulter le détail du panier de la semaine 
    - Réserver un/des paniers

    - Se connecter en tant qu'administrateur 
        -Ajouter/Modifier/Supprimer les articles
        -Ajouter des paniers
        -Consulter la liste des utilisateurs qui ont réservé des paniers
        
 Pour installer le projet :
    - composer install
    - yarn install
    - yarn encore dev
    
Pour charger la base de données :
    -symfony console d:d:c (création de la base de données)
    -symfony console d:m:m (importation des migrations)
    -symfony console d:f:l (importation des fixtures)
    
