<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html lang="en" xml:lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
    <h1>Клиенты, которые плохо себя вели в салоне</h1>
    <table>
        <caption>На текущий месяц</caption>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
        </tr>
        <?php
        include($_SERVER['DOCUMENT_ROOT'] . "/controllers/second_page_controller.php");
        $controller = new SecondPageController();
        $controller->showClients();
        ?>
    </table>
    <script src="" async defer></script>
</body>

</html>
