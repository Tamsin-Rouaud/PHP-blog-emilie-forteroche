<?php
// test_article_manager.php

// Inclure les fichiers nécessaires
require_once 'models/ArticleManager.php'; // Adapte le chemin selon ton projet
require_once 'models/Article.php';       // Si besoin, inclure la classe Article

// Initialiser ArticleManager
$articleManager = new ArticleManager(); // Adapte selon ton projet

// Tester la fonction avec tri par nombre de commentaires
$articles = $articleManager->getAllArticlesWithDetails('number_of_comments', 'DESC');

// Afficher les résultats
foreach ($articles as $article) {
    echo $article->getTitle() . " - " . $article->getNumberOfComments() . "\n";
}
