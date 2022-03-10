<?php

namespace App\Entity;

class BusType
{
    private $name;
    private $size;
    private $length;
    private $price = array();

    public function __construct($name, $size, $length, $price){
        $this->name = $name;
        $this->size = $size;
        $this->length = $length;
        $this->price = array(
            1 => $price,
            2 => $price + 100,
            3 => $price + 200,
            4 => $price + 300,
        );
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getSize(){
        return $this->size;
    }

    public function setSize($size){
        $this->size = $size;
    }

    public function getLength(){
        return $this->length;
    }

    public function setLength($length){
        $this->length = $length;
    }

    public function getPrice($time){
        if (array_key_exists($time, $this->price)){
            return $this->price[$time];
        }
    }

    public function setPrice($time, $price){
        $this->price[$time] = $price;
    }
}