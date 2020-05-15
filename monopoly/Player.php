<?php
/**
 * Created by PhpStorm.
 * User: balai
 * Date: 13/05/2020
 * Time: 10:27
 */
include "City.php";
include "Card.php";

class Player {

    public $playerName, $playerCity, $money, $card;

    public function __construct ($playerName, $playerCity, $money, $card) {
        $this->playerName = $playerName;
        $this->playerCity = $playerCity;
        $this->money = $money;
        $this->card = $card;
    }

    public function payPlayer ($player, $city) {
        if ($this->money >= $city->rent && !$city->isMortgaged && in_array($player->playerCity, $city)) {
            $this->money -= $city->rent;
            $player->money += $city->rent;
            echo $this->playerName . " à donné " . $city->rent . " à " . $player->playerName;
        } else {
            echo $this->playerName . " n'a pas assez de crédit et doit hypothéquer.";
        }
    }

    public function dice () {
        return $dice = rand(1,6);
    }

    public function buyCity ($city) {
        if (!$city->isBought && $this->money >= $city->price) {
            $this->money -= $city->price;
            $this->playerCity[] = $city;
            $city->isBought = true;
        } elseif ($city->isBought == false && $this->money <= $city->price) {
            echo "Vous n'avez pas assez d'argent.";
        } else {
            echo "Cette ville appartient déjà à un joueur.";
        }
    }

    public function pickACard ($aCard) {
        $this->card[] = $aCard;
    }

    public function mortgage ($city) {
        if (in_array($this->playerCity, $city) && !$city->isMorgaged) {
            $this->money += $city->sellPrice;
            $city->isMorgaged = true;
        } elseif (in_array($this->playerCity, $city)) {
            echo "La ville de " . $city->name . " est déjà hypothéquée.";
        } else {
            echo "Vous ne pouvez pas hypothéquer une ville que vous ne possédez pas";
        }
    }

    public function buyHouse ($city) {
        if ($city instanceof City) {
            if (in_array($city, $this->playerCity[$city->cityGroup])) {
                if (
                    (
                        count($this->playerCity[$city->cityGroup]) == 3
                    )
                    ||
                    (
                        (
                            count($this->playerCity[$city->cityGroup])==2
                            &&
                            in_array($city->cityGroup,[0,7])
                        )
                    )
                ) {
                    $minHouse = 5;
                    $isMortgaged = false;

                    foreach($this->playerCity[$city->cityGroup] as $pro){
                        if($pro->house < $minHouse){
                            $minHouse = $pro->house;
                        }
                        if ($pro->isMorgaged) {
                            $isMortgaged = true;
                        }
                    }
                    if (!$isMortgaged) {
                        if ($city->house <= $minHouse) {
                            if ($city->house == 4) {
                                if ($this->money >= $city->hotelPrice) {
                                    $this->money -= $city->hotelPrice;
                                    $city->house ++;
                                    $city->updateRentPrice();
                                } else {
                                    echo "Pas assez d'argent pour acheter un hotel.";
                                }
                            } else {
                                if ($this->money >= $city->hotelPrice) {
                                    $this->money -= $city->hotelPrice;
                                    $city->house ++;
                                    $city->updateRentPrice();
                                } else {
                                    echo "Pas assez d'argent pour acheter une maison.";
                                }
                            }
                        }elseif ($city->house == 5) {
                            echo "Vous ne pouvez pas acheter un autre hotel.";
                        } else {
                            echo "Vous devez acheter d'autres maisons sur les propriétés du même groupe.";
                        }
                    } else {
                        echo "Une des villes de ce groupe et hypothéquée";
                    }
                } else {
                    echo "Vous ne possédez pas toutes les villes de ce groupe.";
                }
            } else {
                echo "Vous ne possédez pas cette propriété.";
            }
        } else {
            echo "C'est pas une ville wesh.";
        }
    }

    public function sellHouse ($city) {
        if ($city instanceof City) {
            if (in_array($city,$this->playerCity[$city->cityGroup])) {
                if ($city->house) {
                    $this->money += round($city->rentPrices[$city->house] / 2);
                    $city->house --;
                    $city->updateRentPrice();
                } else {
                    echo "Il n'y a rien a vendre";
                }
            } else {
                echo "Cette ville ne vous appartient pas";
            }
        } else {
            echo "C'est pas une ville wesh";
        }
    }
}