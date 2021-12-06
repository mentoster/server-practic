

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
    <style>
        
    </style>
</head>
<?php
include('/data/service/Manager.php');
session_name('index');
session_start();
if ($_SESSION['isDark'] == "off") {
    echo '<body style="background-color: white;';
} else {
    echo '<body style="background-color: gray;">';
}
?>


<div style="width: 328px; height: 377px; display: inline-flex; flex-direction: column; align-items: flex-start; justify-content: flex-start;">
    <p style="font-size: 24px; line-height: 100%; color: black;">Ваше имя:<br /></p>
    <p style="font-size: 24px; line-height: 100%; color: rgba(0, 99.60, 229.39, 1);">
        <?php if (!array_key_exists('name', $_SESSION)) {
            $_SESSION['name'] = 'Нет имени';
        }
        echo $_SESSION['name'];
        ?>

    </p>
    <div style="height: 24px;" />
    <p style="width: 318px; height: 24px; font-size: 24px; line-height: 100%; color: black;">Тема темная?</p>
    <p style="width: 103px; font-size: 24px; line-height: 100%; color: rgba(0, 99.60, 229.39, 1);">
        <?php
        echo $_SESSION['isDark'];
        ?>
    </p>
    <div style="height: 24px;" />
    <p style="width: 318px; height: 27px; font-size: 24px; line-height: 100%; color: black;">На каком языке говорите?</p>
    <div style="height: 24px;" />
    <p style="width: 103px; font-size: 24px; line-height: 100%; color: rgba(0, 99.60, 229.39, 1);">
        <?php if (!array_key_exists('lang', $_SESSION)) {
            $_SESSION['lang'] = 'Русский';
        }
        echo $_SESSION['lang'];
        ?></p>
</div>
<?php
$_SESSION['name'] = $_GET['name'];
$theme =        $_GET['isDark'];
if ($theme != "on") {
    $theme = "off";
}
$_SESSION['isDark'] = $theme;
$_SESSION['lang'] = $_GET['lang'];
?>
<form name="form" action="" method="get">
    <p style="width: 408px;font-size: 32px; line-height: 100%; color: black;">Введите данные</p>
    <div style="height: 132px; display: inline-flex; flex-direction: column; align-items: flex-start; justify-content: flex-start;">
        <p style="width: 216px; height: 25px; font-size: 24px; line-height: 100%; color: black;">Введите ваше имя:<br /></p>
        <input type="text" name="name" id="name" value="Дмитрий">
        <p style="width: 318px; height: 24px; font-size: 24px; line-height: 100%; color: black;">Какую тему предпочитаете?</p>
        <div style="height: 24px;" />
        <div>
            <input type="checkbox" checked="checked" name="isDark" id="isDark" />
            <label for="isDark">Темная</label>
        </div>
        <p style="width: 318px; height: 18px; font-size: 24px; line-height: 100%; color: black;">На каком языке говорите?</p>
        <div style="height: 24px;" />
        <input type="text" name="lang" id="lang" value="Русский">
        <div style="height: 24px;" />
        <input type="submit" name="submit" />
    </div>
</form>
<p>Отправьте pdf на сервер</p>
<form action="/data/service/upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>
<p>Файлы на сервере:</p>
<?php
$result = shell_exec('cd uploads && ls && cd ..');
echo str_replace(" ", "\n", $result);
?>
<?php

?>
<form name="form" action="" method="get">
    <div>
        <input type="checkbox" name="fileDownload" id="fileDownload" />
        <label for="fileDownload">Скачать файл?</label>
    </div>
    <input type="text" name="whatfile" id="whatfile" value="swaha.pdf">
    <input type="submit" name="submit" value="Отправить">
</form>
<?php

$filename = "/home/public_html/uploads/" . $_GET['whatfile'];

if (file_exists($filename) &&  $_GET['fileDownload'] == "on") {

    //Get file type and set it as Content Type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    header('Content-Type: ' . finfo_file($finfo, $filename));
    finfo_close($finfo);

    //Use Content-Disposition: attachment to specify the filename
    header('Content-Disposition: attachment; filename=' . basename($filename));

    //No cache
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    //Define file size
    header('Content-Length: ' . filesize($filename));

    ob_clean();
    flush();
    readfile($filename);
    exit;
}
?>

<?php

if (!array_key_exists('visit', $_SESSION)) {
    $_SESSION['visit'] = 0;
}
$_SESSION['visit']++;

echo nl2br('Вы были тут ' . $_SESSION['visit'] . ' раз.');
?>
</form>

<!-- <h1>Лучшие клиенты нашего салона</h1>
    <table>
        <caption>на текущий месяц</caption>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
        </tr>
        <?php
        $mysqli = new mysqli("appDB", "user", "password", "appDB");
        $result = $mysqli->query("SELECT * FROM users");
        foreach ($result as $row) {
            echo "<tr><td>{$row['name']}</td><td>{$row['surname']}</td></tr>";
        }

        ?> -->
</table>
<script src="" async defer></script>
</body>

</html>
