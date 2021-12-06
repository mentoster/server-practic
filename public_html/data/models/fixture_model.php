<?php

class StockFixtureModel
{
    public $name = null;
    public $price = 0;
    // min for today
    public $maxPrice = 0;
    public $minPrice = 0;
    public $time;

    public function randomData()
    {
        // random three chars from 2 to 3
        $this->name = $this->generateRandomString(mt_rand(2, 4));
        // random price
        $this->price = $this->randomNumber(mt_rand(1, 2));
        $this->maxPrice  = $this->price + $this->randomNumber(2);
        $this->minPrice  = $this->price - $this->randomNumber(2);
        // random date between -2 weeks and now
        $this->time = $this->rand_date("-1 week", "now");
    }
    private function randomNumber($length)
    {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(1, 9);
        }

        return $result;
    }
    private function generateRandomString($length = 10)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    private function rand_date($min_date, $max_date)
    {
        /* Gets 2 dates as string, earlier and later date.
       Returns date in between them.
        */

        $min_epoch = strtotime($min_date);
        $max_epoch = strtotime($max_date);

        $rand_epoch = rand($min_epoch, $max_epoch);

        return $rand_epoch;
        return date('Y-m-d H:i:s', $rand_epoch);
    }
    public function toString()
    {
        return "StockModel:\nName: " . $this->name .
            "\nPrice: " . $this->price .
            "\nMaxPrice: " . $this->maxPrice .
            "\nMinPrice: " . $this->minPrice .
            "\nTime: " . $this->time;
    }
}
