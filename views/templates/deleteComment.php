<?php 
    /** 
     * Gestion de la partie suppression des commentaires en fonction des articles. Affichage de cette page via le lien "Suppression des commentaires de la partie dashboard..
     */
?>

<h2>Suppression des commentaires</h2>

<?php foreach ($articles as $article) { ?>
    <div class="article-section" id="article-<?= $article->getId() ?>"> <!-- ID unique basé sur l'article -->
        <!-- Titre de l'article et ses informations -->
        <h3><?= $article->getTitle() ?></h3>
        <p><strong>Date de création :</strong> <?= Utils::convertDateToFrenchFormat($article->getDateCreation()) ?></p>
        <p><strong>Nombre de commentaires :</strong> <?= count($commentManager->getAllCommentsByArticleId($article->getId())) ?></p>

        <!-- Liste des commentaires associés -->
        <?php $comments = $commentManager->getAllCommentsByArticleId($article->getId()); 
        if (!empty($comments)) { ?>
        <table>
            <thead>
                <tr>
                    <th>Commentaires</th>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment) { ?>
                    <tr>
                        <td><?= $comment->getContent() ?></td>
                        <td><?= $comment->getPseudo() ?></td>
                        <td><?= Utils::convertDateToFrenchFormat($comment->getDateCreation()) ?></td>
                        <td>
                            <a class="delete-button" href="index.php?action=deleteCommentById&id=<?= $comment->getId() ?>"
                                <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce commentaire ?") ?>>
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
        <?php } else { ?>
            <p>Aucun commentaire disponible pour cet article.</p>
        <?php }; ?>
    </div>
    <hr>
<?php }; ?>


<div class="bottomLinks">
    <a class="submit" href="index.php?action=dashboard">Retour au tableau de bord</a>
</div>
