<?php 
    /** 
     * Affichage de la partie Dashboard admin : Tableau de bord permettant le tri et l'affichage 
     * du titre, du nb de commentaires et du nb de vues pour chaque article ainsi que sa date de création.
     * Lien vers le détail des commentaires de chaque article pour pouvoir supprimer les commentaires si nécessaire.
     */
?>
<h2>Tableau de bord</h2>
<table>
    <thead>
        <tr>
            <th>
                <a href="index.php?action=dashboard&sort=title&order=asc">▲</a>
                    Titre de l'article
                <a href="index.php?action=dashboard&sort=title&order=desc">▼</a>
            </th>
            <th>
                <a href="index.php?action=dashboard&sort=comment_count&order=asc">▲</a>
                    Nombre de commentaire(s)
                <a href="index.php?action=dashboard&sort=comment_count&order=desc">▼</a>
            </th>
            <th>
                <a href="index.php?action=dashboard&sort=number_of_views&order=asc">▲</a>
                    Nombre de vues
                <a href="index.php?action=dashboard&sort=number_of_views&order=desc">▼</a>
            </th>
            <th>
                <a href="index.php?action=dashboard&sort=date_creation&order=asc">▲</a>
                    Date de création
                <a href="index.php?action=dashboard&sort=date_creation&order=desc">▼</a>
            </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($articles as $article) { ?>
        <tr>
            <!-- Lien sur le titre vers la page deleteComment avec l'ancre -->
            <td class="articleTitle">
                <a href="index.php?action=showAdminDeleteComment&id=
                <?= $article->getId() ?>#article-<?= $article->getId() ?>">
                    <?= $article->getTitle() ?>
                </a>
            </td>
            <td><?= $article->getNumberOfComments() ?> commentaire(s)</td>
            <td><?= $article->getNumberOfViews() ?> vue(s)</td>
            <td><?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?></td>
        </tr>
    <?php }; ?>
</tbody>
</table>
<div class="bottomLinks dashboard">
    <a class="submit" href="index.php?action=admin">Retour</a>
    <a class="submit" href="index.php?action=deleteCommentById">Suppression des commentaires</a>
</div>
