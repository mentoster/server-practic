<?php
class PhpInfoViewPage
{
    static public function Build()
    {
        phpinfo();
    }
}

$showInfo = new PhpInfoViewPage();
$showInfo->Build();
