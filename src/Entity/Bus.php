<?php

namespace App\Entity;
use App\Entity\BusType;

class Bus
{
    private string $name        = '';
    private string $shortname   = '';
    private string $subtitle    = '';
    private int $room           = 0;
    private int $pictures       = 0;
    private array $options      = array();

    public function __construct(string $name, string $shortname, int $room, int $pictures, string $subtitle = '', array $options = array())
    {
        $this->name         = $name;
        $this->shortname    = $shortname;
        $this->subtitle     = $subtitle;
        $this->room         = $room;
        $this->pictures     = $pictures;
        if (count($options) > 0) {
            foreach ($options as $option) {
                $this->options[$option] = BusType::options[$option];
            }
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getShortname(): string
    {
        return $this->shortname;
    }

    public function setShortname(string $shortname)
    {
        $this->shortname = $shortname;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle)
    {
        $this->subtitle = $subtitle;
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