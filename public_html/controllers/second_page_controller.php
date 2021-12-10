<?php

include $_SERVER['DOCUMENT_ROOT'] . '/data/service/database_service/database_repository.php';
class SecondPageController
{
    private $database;
    public function __construct()
    {
        $this->database = new DatabaseProvider();
    }
    public function showClients()
    {
        $this->database->showBadClients();
    }
}
