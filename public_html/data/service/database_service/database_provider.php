<?php

class DatabaseProvider
{
    private $mysqli;
    public function __construct()
    {
        $this->mysqli = new mysqli("appDB", "user", "password", "appDB");
    }
    public function showBadClients()
    {
        $result = $this->mysqli->query("SELECT * FROM users WHERE name = 'Bob' AND surname = 'Marley'");

        foreach ($result as $row) {
            echo "<tr><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
        }
    }
}
