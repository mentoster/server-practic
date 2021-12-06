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
        // echo exec('htpasswd -b -c ~/home/public_html/ admin 1234');
        $mysqli = new mysqli("appDB", "user", "password", "appDB");
        $result = $mysqli->query("SELECT * FROM users WHERE name = 'Bob' AND surname = 'Marley'");
        foreach ($result as $row) {
            echo "<tr><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
        }
        ?>
    </table>
    <script src="" async defer></script>
</body>

</html>
