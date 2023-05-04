<?php

namespace App\Model;

use PDO;

class ArticleManager extends AbstractManager
{
    public const TABLE = 'article';

    public function selectRandomOne()
    {
        // prepared request
        $statement = $this->pdo->query("SELECT * FROM article ORDER BY RAND() LIMIT 1;");

        return $statement->fetch();
    }

    public function selectArticlesWithKeyword(string $keyword): array
    {
        $query = "SELECT * FROM article WHERE title LIKE :keyword;";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
}
