<?php

/**
 * Entité Article, un article est défini par les champs
 * id, id_user, title, content, date_creation, date_update
 * et number_of_views
 */
 class Article extends AbstractEntity 
 {
    private int $idUser;
    private string $title = "";
    private string $content = "";
    private int $numberOfViews = 0;
    private int $numberOfComments = 0;
    private array $comments = []; // Propriété pour stocker les commentaires
    private ?DateTime $dateCreation = null;
    private ?DateTime $dateUpdate = null;  

    /**
     * Setter pour l'id de l'utilisateur. 
     * @param int $idUser
     */
    public function setIdUser(int $idUser) : void 
    {
        $this->idUser = $idUser;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getIdUser() : int 
    {
        return $this->idUser;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitle(string $title) : void 
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle() : string 
    {
        return $this->title;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     */
    public function setContent(string $content) : void 
    {
        $this->content = $content;
    }

    /**
     * Getter pour le contenu.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getContent(int $length = -1) : string 
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->content;
    }

     /**
     * Setter pour le nombre de vues d'un article. 
     * @param int $numberOfViews
     */
    public function setNumberOfViews(int $numberOfViews) : void 
    {
        $this->numberOfViews = $numberOfViews;
    }

    /**
     * Getter pour le nombre de vues d'un article.
     * @return int $idArticle
     */
    public function getNumberOfViews() : int 
    {
        return $this->numberOfViews;
    }

    // Méthode pour définir le nombre de commentaires pour cet article
    public function setNumberOfComments(int $commentCount) : void {
        $this->numberOfComments = $commentCount;
    }

    // Méthode pour récupérer le nombre de commentaires pour cet article
    public function getNumberOfComments() : int {
        return $this->numberOfComments;
    }

    /**
     * Setter pour les commentaires associés à l'article
     * @param array $comments
     */
    public function setComments(array $comments) : void
    {
        $this->comments = $comments;
    }

    /**
     * Getter pour les commentaires associés à l'article
     * @return array
     */
    public function getComments() : array
    {
        return $this->comments;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s') : void 
    {
        if (is_string($dateCreation)) {
            $dateCreation = DateTime::createFromFormat($format, $dateCreation);
        }
        $this->dateCreation = $dateCreation;
    }

    /**
     * Getter pour la date de création.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime
     */
    public function getDateCreation() : DateTime 
    {
        return $this->dateCreation;
    }

    /**
     * Setter pour la date de mise à jour. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateUpdate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé.
     */
    // public function setDateUpdate(string|DateTime $dateUpdate, string $format = 'Y-m-d H:i:s') : void 
    // {
    //     if (is_string($dateUpdate)) {
    //         $dateUpdate = DateTime::createFromFormat($format, $dateUpdate);
    //     }
    //     $this->dateUpdate = $dateUpdate;
    // }



// Modification de la fonction qui posait problème lors de l'ajout d'un article.
public function setDateUpdate(string|DateTime|null $dateUpdate, string $format = 'Y-m-d H:i:s') : void 
{
    if ($dateUpdate === null) {
        $this->dateUpdate = null;  // Si la date est null, on affecte null
    } elseif (is_string($dateUpdate)) {
        $dateUpdate = DateTime::createFromFormat($format, $dateUpdate);
        $this->dateUpdate = $dateUpdate;
    } else {
        $this->dateUpdate = $dateUpdate;  // Si c'est déjà un DateTime, on l'affecte directement
    }
}






    /**
     * Getter pour la date de mise à jour.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime ou null
     * si la date de mise à jour n'a pas été définie.
     * @return DateTime|null
     */
    public function getDateUpdate() : ?DateTime 
    {
        return $this->dateUpdate;
    }
 }