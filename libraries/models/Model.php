<?php
namespace Models;

require_once('libraries/database.php');

abstract class Model
/**
 * Classe abstraite : cela veut dire qu'on ne peut pas l'appeler 
 * ce n'est pas un vrai model que l'on peur instantier 
 * on s'en sert dans d'autres models pour pour l'heriter
 */
{
    protected $table;
    protected $pdo;
    //protected , reservé a cette classe et a ses enfants uniquement
    public function __construct()
    {
        /**
         * a la naissance de mon objet , ce dernier heritera
         * d'une propriété pdo et sa valeur est ici
         */
        $this->pdo = getPdo();
    }

    function findAll(?string $order = ""): array
    {
        /**
         * 2. Retourne liste articles par date de creation
         *  @return array
         * $order est un argument facultatif 
         * si je le precise alors il sera rajoutrer a la requete sql si non cest vide
         */
        $sql = "SELECT * FROM {$this->table}";
        if($order)
        {
            $sql .= " ORDER BY ".$order;
        }

        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles  

        $articles = $resultats->fetchAll();
        return $articles;
    }
    function findAllWithArticle($article_id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();
        return $commentaires;
    }

    function find($id)
    {

        /**
         * 3. Récupération de l'article en question
         * On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
         * jamais confiance à ce connard d'utilisateur ! :D
         */
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :article_id");

        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['article_id' => $id]);

        // On fouille le résultat pour en extraire les données réelles de l'article
        $article = $query->fetch();
        return $article;
    }
    function delete($id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
    function insert(string $author, string $content ,int $article_id)
    {   
        
       
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET author = :author, content = :content, article_id = :article_id, created_at = NOW()");
        $query->execute(compact('author', 'content', 'article_id'));
        
    }
}
