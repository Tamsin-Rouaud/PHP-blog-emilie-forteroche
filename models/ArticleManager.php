<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles() : array
    {
        $sql = "SELECT * FROM article";
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
        return $articles;
    }
    
    public function getAllArticlesWithDetails(string $sort = 'date_creation', string $order = 'DESC') : array
    {
        // Liste des colonnes autorisées pour le tri
        $allowedSorts = [
            'title' => 'title',
            'comment_count' => 'comment_count',
            'number_of_views' => 'number_of_views',
            'date_creation' => 'date_creation'
        ];
        // Liste des ordres autorisés pour le tri (ASC ou DESC)
        $allowedOrders = ['asc', 'desc'];
        // Validation des paramètres
        // Si le paramètre `$sort` n'est pas dans la liste des colonnes autorisées, on utilise 'date_creation' par défaut.
        $sort = $allowedSorts[$sort] ?? 'date_creation';
        // Si l'ordre `$order` n'est pas valide (ni 'asc' ni 'desc'), on utilise 'DESC' par défaut.
        $order = in_array($order, $allowedOrders) ? strtoupper($order) : 'DESC';
        // - Les résultats sont triés dynamiquement en fonction des paramètres `$sort` et `$order`.
        $sql = "SELECT a.id, a.title, a.date_creation, a.number_of_views, COUNT(c.id) AS comment_count
        FROM article a LEFT JOIN comment c ON a.id = c.id_article GROUP BY a.id ORDER BY $sort $order";
        // Exécution de la requête
        $result = $this->db->query($sql);
        // Initialisation d'un tableau pour récupérer les valeurs de articles
        $articles = [];

        // Création des objets Article à partir des résultats
        while ($article = $result->fetch()) {
            // Création de l'objet Article avec les données récupérées
            $articleObj = new Article($article);  
            // Ajout manuel du nombre de commentaires car inexistant en base
            $articleObj->setNumberOfComments((int)$article['comment_count']); 
            // Ajout de l'objet Article au tableau 
            $articles[] = $articleObj;
        }
        
        return $articles;
    }

    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id) : ?Article
    {
        $sql = "SELECT * FROM article WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article) : void 
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article) : void
    {
        
        $sql = "INSERT INTO article (id_user, title, content, date_creation) VALUES (:id_user, :title, :content, NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);
        
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article) : void
    {
        $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'id' => $article->getId()

        ]);
        if (empty($article->getDateUpdate())) {
    $article->setDateUpdate(date('Y-m-d H:i:s'));  // Définit la date actuelle
}

    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id) : void
    {
        $sql = "DELETE FROM article WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }

    
    /**
    * Incrémente le nombre de vues d'un article.
    * 
    * @param int $id L'identifiant de l'article.
    * @return void
    */
    public function incrementViews(int $id) : void
    {
        $sql = "UPDATE article SET number_of_views = number_of_views + 1 WHERE id = :id";
        $this->db->query($sql, [
            'id' => $id
        ]);
    }
}