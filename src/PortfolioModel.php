<?php

declare(strict_types=1);

namespace SpaceX\App;

use SQLite3Result;
use SQLite3;

class PortfolioModel
{
    private SQLite3 $database;

    public function __construct()
    {
        $this->database = new SQLite3(__DIR__ . '/../SQLite_db');
    }

    public function getPortfolio(string $cryptoCurrency = null): SQLite3Result
    {
        $query = 'select * from portfolio where 1=1';
        if ($cryptoCurrency !== null) {
            $query .= ' and name = :name';
        }

        $statement = $this->database->prepare($query);

        if ($cryptoCurrency !== null) {
            $statement->bindValue(':name', $cryptoCurrency, SQLITE3_TEXT);
        }

        return $statement->execute();
    }
}
