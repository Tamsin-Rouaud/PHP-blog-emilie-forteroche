<?php 
    /** 
     * Affichage de la partie Dashboard admin : Tableau de bord pour permettre le tri et l'affichage 
     * du titre des articles, le nombre de commentaires et le nombre de vues pour chaque article 
     * ainsi que sa date de création. Lien vers le détail des commentaires de chaque article pour pouvoir
     * supprimer les commentaires si nécessaire.
     */
?>

<h2>Tableau de bord</h2>

<table border="1">
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
                <td><?= htmlspecialchars($article['title']) ?></td>
                <td><?= htmlspecialchars($article['comment_count']) ?> commentaire(s)</td>
                <td><?= htmlspecialchars($article['number_of_views']) ?> vue(s)</td>
                <td><?= htmlspecialchars($article['date_creation']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
