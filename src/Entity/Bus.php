<?php

namespace App\Entity;
use App\Entity\BusType;

class Bus
{
    private string $name = '';
    private string $short_name = '';
    private int $room = 0;
    private int $pictures = 0;
    private array $options = array();

    public function __construct(string $name, string $short_name, int $room, int $pictures, array $options)
    {
        $this->name         = $name;
        $this->short_name   = $short_name;
        $this->room         = $room;
        $this->pictures     = $pictures;
        foreach ($options as $option){
            $this->options[$option] = BusType::options[$option];
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $short_name)
    {
        $this->short_name = $short_name;
    }

    public function getShortName(): string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name)
    {
        $this->short_name = $short_name;
    }

    public function getRoom(): int
    {
        return $this->room;
    }

    public function setRoom(int $room)
    {
        $this->room = $room;
    }

    public function getPictures(): int
    {
        return $this->pictures;
    }

    public function setPictures(int $pictures)
    {
        $this->pictures = $pictures;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function addOption(string $option)
    {
        if (!array_key_exists($option, $this->options))
            $this->options[$option] = BusType::options[$option];
    }

    public function removeOption(string $option)
    {
        if (array_key_exists($option, $this->options))
            unset($this->options[$option]);
    }
}