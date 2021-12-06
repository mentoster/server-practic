<?php
include("data/models/fixture_model.php");
include('vendor/chartisan/php/src/Chartisan.php');
include("stat_w.php");

use Chartisan\PHP\Chartisan;

$fixtList = array();
for ($i = 0; $i < 51; $i++) {
    $fixt = new StockFixtureModel;
    $fixt->randomData();
    array_push($fixtList, $fixt);
}
$chart = Chartisan::build()
    ->labels(['Мин. цена', 'Цена', 'Макс. цена'])
    ->dataset('GQG ', [2, 4, 6])
    ->dataset('TRT', [2, 3, 7]);
for ($i = 0; $i < 12; $i++) {
    $chart = $chart->dataset($fixtList[$i]->name, [$fixtList[$i]->minPrice, $fixtList[$i]->price, $fixtList[$i]->maxPrice]);
}
$chart = $chart->toJSON();
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <style>
        .img-wrap {
            position: relative;
        }

        .img-wrap h1 {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            color: rgba(1, 1, 1, 0.4);
            font-size: 40px;
        }
    </style>
</head>

<body>
    </br>
    </br>
    </br>
    <div class="container-fluid">
        <div class="row">
            <div class="img-wrap">
                <div id="chart1" style="height: 300px;"></div>
                <h1 id="watermark"></h1>
            </div>
        </div>
    </div>
    </br>
    </br>
    </br>
    <div class="container-fluid">
        <div class="row">
            <div class="img-wrap">
                <div id="chart2" style="height: 300px;"> </div>
                <h1 id="watermark"></h1>
            </div>
        </div>
    </div>
    </br>
    </br>
    </br>
    <div class="container-fluid">
        <div class="row">
            <div class="img-wrap">
                <div id="chart3" style="height: 300px;"></div>
                <h1 id="watermark"></h1>
            </div>
        </div>
    </div>
    </br>
    </br>
    </br>
    <div class="container-fluid">
        <div class="row">
            <div class="img-wrap">
                <div id="chart4" style="height: 300px;"></div>
                <h1 id="watermark"></h1>
            </div>
        </div>
    </div>
    </br>
    </br>
    </br>
    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <script>
        const chart1 = new Chartisan({
            el: '#chart1',
            hooks: new ChartisanHooks()
                .datasets('line')
                .title('Линейный график')
                .colors(["#FFFFFF"])
                .borderColors(),

            data: <?php
                    echo $chart;
                    ?>
        })
        const chart2 = new Chartisan({
            el: '#chart2',
            hooks: new ChartisanHooks()
                .beginAtZero()
                .colors()
                .title('Столбчатый график')

                .borderColors(),

            data: <?php
                    echo $chart;
                    ?>
        })
        const chart3 = new Chartisan({
            el: '#chart3',
            hooks: new ChartisanHooks()
                .datasets('doughnut')
                .title('Пончиков график')
                .pieColors(),
            data: <?php
                    echo $chart;
                    ?>
        })
        const chart4 = new Chartisan({
            el: '#chart4',
            hooks: new ChartisanHooks()
                .datasets('pie')
                .title('График пирог')
                .pieColors(),
            data: <?php
                    echo $chart;
                    ?>
        })
        for (let i = 1; i < 5; ++i) {
            setTimeout(() => {
                var img = document.getElementById("img" + i);
                img.style = "max-width: 99%;";
                img.src = document.querySelector("#chart" + i + " > div > div:nth-child(1) > canvas").toDataURL("image/png");

                var sendValue = document.getElementById("sendImg" + i);
                sendValue.value = img.src;
            }, 1000);
        }
    </script>
    <?php

    // watermark_image('image_name.jpg', 'watermark.png', 'new_image_name.jpg');
    for ($i = 0; $i < 51; $i++) {
        echo $fixtList[$i]->toString() . "</br>";
    }

    ?>


    <div class="container-fluid">
        <div class="row">
            <div class="img-wrap">
                <img id="img1" src="" class="img-responsive">
                <h1 id="watermark"></h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="img-wrap">
                <img id="img2" src="" class="img-responsive">
                <h1 id="watermark"></h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="img-wrap">
                <img id="img3" src="" class="img-responsive">
                <h1 id="watermark"></h1>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="img-wrap">
                <img id="img4" src="" class="img-responsive">
                <h1 id="watermark"></h1>
            </div>
        </div>
    </div>
    </br>
    </br>
    </br>

    <form name="form" action="<?php $_PHP_SELF ?>" method="POST">
        <div>
            <input type="checkbox" name="saveit" id="saveit" />
            <label for="label">сохранить картинки?</label>
        </div>
        <input type="submit" name="submit" value="Создать картинки">
        <input name="sendImg1" id="sendImg1" value="">
        <input name="sendImg2" id="sendImg2" value="">
        <input name="sendImg3" id="sendImg3" value="">
        <input name="sendImg4" id="sendImg4" value="">
    </form>
    </br>
    </br>
    </br>
    <img src="charts/watermarkChart1.png" alt="">
    <img src="charts/watermarkChart2.png" alt="">
    <img src="charts/watermarkChart3.png" alt="">
    <img src="charts/watermarkChart4.png" alt="">
    <div id="bottom-images"></div>

    <?php

    if ($_POST['saveit'] == "on") {
        watermark_image($_POST['sendImg1'], 'charts/watermark.fVdER.png', 'charts/watermarkChart1.png');
        watermark_image($_POST['sendImg2'], 'charts/watermark.fVdER.png', 'charts/watermarkChart2.png');
        watermark_image($_POST['sendImg3'], 'charts/watermark.fVdER.png', 'charts/watermarkChart3.png');
        watermark_image($_POST['sendImg4'], 'charts/watermark.fVdER.png', 'charts/watermarkChart4.png');
    }

    ?>
</body>

</html>
