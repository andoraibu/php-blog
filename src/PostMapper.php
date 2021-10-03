<?php

namespace Blog;

use PDO;

class PostMapper
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getByUrlKey(string $urlKey): array
    {
        $this->connection->prepare('SELECT * FROM post WHERE url_key = :url_key');
    }

}