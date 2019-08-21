<?php

const MONTHS = array(
    "January",
    "February",
    "March",
    "April"
);

const CHEMICALS = array(
    "admire" => "Admire",
    "acromite" => "Acromite",
    "ferbam" => "Ferbam",
    "nitrogen" => "Nitrogen"
);

const FARMS = array(
    "c" => "Farm C",
    "b" => "Farm B",
    "a" => "Farm A",
    "d" => "Farm D"
);

const BLOCKS = array(
    "Block 4",
    "Block 2",
    "Block 3",
    "Block 1"
);

const CROPS = array(
    "Apples",
    "Pears",
    "Peaches",
    "Apricots"
);

const KEY_MAP = array(
    "month" => MONTHS,
    "chemical" => CHEMICALS,
    "farm" => FARMS,
    "block" => BLOCKS,
    "crop" => CROPS
);

const VALUE_MAP = array(
    "amount",
    "total"
);

function pick_random($arr) {
    $rand = rand(0, count($arr) - 1);
    $key = array_keys($arr)[$rand];
    return $arr[$key];
}

//todo: make farm node class to find sum of acres

class Item {
    var $date;
    var $month;
    var $farm;
    var $block;
    var $chemical;
    var $amount;
    var $crop;
    var $total;

    function __construct() {
        $this->date = rand(1547953146, 1566269956);
        $this->month = pick_random(MONTHS);
        $this->farm = pick_random(FARMS);
        $this->block = pick_random(BLOCKS);
        $this->chemical = pick_random(CHEMICALS);
        $this->amount = 100 * mt_rand() / mt_getrandmax();
        $this->total = 100 * mt_rand() / mt_getrandmax();
        $this->crop = pick_random(CROPS);
    }
}