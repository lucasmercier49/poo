<?php
class Card {

    public $name, $effect;

    public function __construct ($name, $effect) {
        $this->effect = $effect;
        $this->name = $name;
    }

    public function toString(){
        return "Name: " .$this->name. ", effect: " .$this->effect.".<br>";
    }

    public function useMoneyCard ($player, $money) {
        $player->money += $money;
    }
}
