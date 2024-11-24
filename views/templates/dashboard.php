<?php 
    /** 
     * Affichage de la partie Dashboard admin : Tableau de bord pour permettre le tri et l'affichage 
     * du titre des articles, le nombre de commentaires et le nombre de vues pour chaque article 
     * ainsi que sa date de création. Lien vers le détail des commentaires de chaque article pour pouvoir
     * supprimer les commentaires si nécessaire.
     */
?>

<h2>Tableau de bord</h2>

<table>
    <thead>
        <tr>
            <th>Titre de l'article</th>
            <th>Commentaires associés</th>
            <th>Nombre de vues</th>
            <th>Date de création</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <!-- Utilisation des getters pour récupérer les données de l'article -->
                <td class="articleTitle"><?= $article->getTitle() ?></td>
                <td><?= $article->getNumberOfComments() ?> commentaire(s)</td>
                <td><?= $article->getNumberOfViews() ?> vue(s)</td>
                <td><?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a class="checkComments" href=#>Gérer les commentaires</a>
