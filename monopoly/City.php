<?php
class City{
    public $name;
    public $price;
    public $rent;
    public $sellPrice;
    public $isMortgaged = false;
    public $mortgagedPrice;
    public $isBought = false;
    public $house = 0;
    public $housePrice;
    public $hotelPrice;
    public $rentPrices;
    public $cityGroup;


    public function  __construct ($name, $price, $sellPrice,$isMortgaged, $cityGroup, $mortgagedPrice, $isBought, $housePrice, $hotelPrice, $rentPrices) {
        $this->name = $name;
        $this->price = $price;
        $this->sellPrice = $sellPrice;
        $this->isMortgaged = $isMortgaged;
        $this->mortgagedPrice = $mortgagedPrice;
        $this->isBought = $isBought;
        $this->rent = $rentPrices[0];
        $this->housePrice = $housePrice;
        $this->hotelPrice = $hotelPrice;
        $this->rentPrices = $rentPrices;
        $this->cityGroup = $cityGroup;
    }

    public function updateRentPrice(){
        $rentPercentage = $this->house;
        $this->rent = $this->rentPrices[$rentPercentage];
    }

}
