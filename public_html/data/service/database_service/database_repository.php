<?php
include $_SERVER['DOCUMENT_ROOT'] . '/data/service/database_service/database_provider.php';

class DatabaseRepository
{
    private $provider;
    public function __construct()
    {
        $this->provider = new  DatabaseProvider();
    }
    public function showBadClients()
    {
        $this->provider->showBadClients();
    }
}
