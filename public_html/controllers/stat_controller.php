<?php
include($_SERVER['DOCUMENT_ROOT'] . "/data/models/fixture_model.php");
include($_SERVER['DOCUMENT_ROOT'] . "/vendor/chartisan/php/src/Chartisan.php");

use Chartisan\PHP\Chartisan;

class StatPageController
{
    public $chartJson;
    public $fixtList;
    public function __construct()
    {
        $this->GenerateFixtures();
    }
    public function GenerateFixtures()
    {
        $this->fixtList = array();
        for ($i = 0; $i < 51; $i++) {
            $fixt = new StockFixtureModel;
            $fixt->randomData();
            array_push($this->fixtList, $fixt);
        }
        $chart = Chartisan::build()
            ->labels(['Мин. цена', 'Цена', 'Макс. цена'])
            ->dataset('GQG ', [2, 4, 6])
            ->dataset('TRT', [2, 3, 7]);
        for ($i = 0; $i < 12; $i++) {
            $chart = $chart->dataset($this->fixtList[$i]->name, [$this->fixtList[$i]->minPrice, $this->fixtList[$i]->price, $this->fixtList[$i]->maxPrice]);
        }
        $this->chartJson = $chart->toJSON();
    }
    public function GenerateWaterMarks($img1, $img2, $img3, $img4)
    {
        $waterMarkPath = 'charts/watermark.fVdER.png';
        watermark_image($img1, $waterMarkPath, 'charts/watermarkChart1.png');
        watermark_image($img2, $waterMarkPath, 'charts/watermarkChart2.png');
        watermark_image($img3, $waterMarkPath, 'charts/watermarkChart3.png');
        watermark_image($img4, $waterMarkPath, 'charts/watermarkChart4.png');
    }
}
