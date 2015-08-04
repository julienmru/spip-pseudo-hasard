# spip-pseudo-hasard

Ajoute un critère de tri {par pseudo_hasard} qui se comporte comme {par hasard} mais qui est mis à jour tous les jours au lieu d'être mis à jour au calcul du squelette. La conséquence pratique est que l'on peut utiliser la pagination en ayant de l'aléatoire sans doublons ({par hasard} crée intrinsèquement des doublons avec la pagination). Il fonctionne sur tous les objets éditoriaux (articles, rubriques, etc.).

**Conseil :** Mettre une durée de cache à quelques heures sur les squelettes appelant {par pseudo_hasard}.

*Note technique : bien sûr, pseudo_hasard est aussi renseigné à la création d'un objet éditorial, pas uniquement via le cron.*