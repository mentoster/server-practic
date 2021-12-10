<?php

class SecondPageController
{
    public function showClients()
    {
        $mysqli = new mysqli("appDB", "user", "password", "appDB");
        $result = $mysqli->query("SELECT * FROM users WHERE name = 'Bob' AND surname = 'Marley'");
        foreach ($result as $row) {
            echo "<tr><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
        }
    }
}
